let csrfToken = "";
let coverImageDropzone = null;
let updatingBookId = null;

document.addEventListener('DOMContentLoaded', () => {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    coverImageDropzone = new DropZone().createSimpleSingleFileDropzone(".cover_file_input_dropzone");
    init();


    document.querySelector('#selectFileModalOpener').addEventListener('click', function () {
        const modalElement = document.getElementById('selectFile');
        const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);

        updatingBookId = document.getElementById("selectedFileId").getAttribute("data-updating-book") ?? "";

        modal.show();
    });

});

function init() {
    enableQuillEditor("#quill-editor");

    enableRadioTogglingOnFileSelector();

    enableDynamicBranchAndSemester("#branch_selector", '#semester_selector');

    enableFileSearching("#searchFileInput", "#fileSelectionArea");

    bookSelection();

    editingBook();
}

function enableQuillEditor(selector) {

    const quillEditorObj = new QuillEditor().getQuillEditorObject(selector);

    const form = document.getElementById('addBookForm');
    const description = document.getElementById('description');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const htmlContent = quillEditorObj.root.innerHTML;
        description.value = htmlContent;

        // const selectBranch = form.querySelector("#branch_selector");
        // const inputBranchId = form.querySelector("#branch_id_input");
        // let selectedOption =  selectBranch.options[selectBranch.selectedIndex];
        // inputBranchId.value  = selectedOption.getAttribute("data-branch-id");

        // console.log('attr', selectedOption.getAttribute("data-branch-id"));

        form.submit();
    });

}

function enableRadioTogglingOnFileSelector() {
    document.querySelectorAll(".file-selection-area .file-card").forEach(element => {
        element.addEventListener('click', () => {
            const checkbox = element.querySelector('input[type="radio"]');

            if (checkbox) {
                checkbox.checked = true;
            }
        });
    });
}

function enableDynamicBranchAndSemester(branchSelector, semesterSelector) {
    const branchSelect = document.querySelector(branchSelector);
    const semesterSelect = document.querySelector(semesterSelector);

    if (!branchSelect || !semesterSelect) {
        console.error('Branch or semester selector not found!');
        return;
    }

    // Ensure that all existing options are converted to Choices.js format
    const initialOptions = Array.from(branchSelect.options).map(option => ({
        value: option.value,
        label: option.textContent, // Display name
        customProperties: option.getAttribute('data-custom-properties') || '', // Allow search by name
        selected: option.selected, // Keep selected state
    }));

    let branchChoices = new Choices(branchSelect, {
        removeItemButton: true,
        searchEnabled: true,
        shouldSort: false,
        itemSelectText: '',
        searchFields: ['label', 'customProperties'], // Enables searching by name
    });

    branchChoices.setChoices(initialOptions, 'value', 'label', true);

    let semesterChoices = new Choices(semesterSelect, {
        removeItemButton: true,
        searchEnabled: true,
    });

    function loadSemester() {
        const branchId = branchSelect.value;
        const branchName = branchSelect.options[branchSelect.selectedIndex]?.getAttribute('data-custom-properties');
        const semesterId = semesterSelect.getAttribute('data-value') || semesterSelect.value;

        const url = new URL(route('api.fetch.semesters'));
        url.searchParams.append('branch_id', branchId);
        url.searchParams.append('branch_name', branchName);

        const resetSemesterChoices = (label) => {
            semesterChoices.clearChoices();
            semesterChoices.setChoices([{ value: '', label, disabled: true, selected: true }]);
        };

        fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'x-csrf-token': csrfToken,
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.data.length > 0) {
                        console.log('Semesters:', data.data);

                        const choices = data.data.map(semester => ({
                            value: semester.id,
                            label: `${semester.title} ➜ ${semester.sub_title}`,
                            selected: semesterId == semester.id
                        }));

                        resetSemesterChoices('--select semester--');
                        semesterChoices.setChoices(choices, 'value', 'label', true);

                        if (choices.some(choice => choice.value == semesterId)) {
                            console.log('Setting selected semester:', semesterId);
                            semesterChoices.setChoiceByValue(semesterId);
                        }
                    } else {
                        resetSemesterChoices('No result found!');
                    }
                } else {
                    resetSemesterChoices('Error loading data!');
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error.message || error);
                resetSemesterChoices('Error fetching data!');
            });
    }

    branchSelect.addEventListener('change', loadSemester);

    if (branchSelect.value) {
        loadSemester();
    }
}



function bookSelection() {

    const doneBtn = document.querySelector('#fileSelectionDoneBtn');
    const pickerTextContent = document.querySelector("#selectFilePickerText");
    const selectedPreview = document.querySelector('#selectedFilePreview');

    if (!doneBtn) {
        return;
    }

    doneBtn.addEventListener('click', () => {
        const fileSelectionArea = document.querySelector('#fileSelectionArea');

        let radios = fileSelectionArea.querySelectorAll('input[type="radio"]');
        radios.forEach(element => {
            if (element.checked) {

                document.querySelector("#selectedFileId").value = element.value;

                selectedPreview.querySelector(".file_name").innerHTML = element.parentNode.querySelector('.title-area .title').innerHTML;
                selectedPreview.querySelector(".size").innerHTML = element.parentNode.querySelector('.title-area .size').innerHTML;


                if (pickerTextContent && !pickerTextContent.classList.contains('hide')) {
                    pickerTextContent.classList.add('hide')
                }

                selectedPreview.querySelector(".close-btn").addEventListener('click', () => {
                    document.querySelector("#selectedFileId").value = "";

                    selectedPreview.classList.add('hide');
                    if (pickerTextContent && pickerTextContent.classList.contains('hide')) {
                        pickerTextContent.classList.remove('hide')
                    }
                });

                const fileService = new FileService();
                const extensionIcon = fileService.getIconFromExtension(element.parentNode.querySelector('.title-area .extension').innerHTML);
                selectedPreview.querySelector(".icon-container").innerHTML = `<i class="bi ${extensionIcon} icon-bg" id="extensionIcon"></i>`;

                selectedPreview.classList.remove('hide');

                // close modal
                const modalElement = document.getElementById('selectFile');
                const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                modal.hide();
            }
        });

    });
}

function enableFileSearching(searchInputSelector, containerSelector) {
    const searchInput = document.querySelector(searchInputSelector);
    const container = document.querySelector(containerSelector);
    let page = 2;
    let isLoading = false;
    let hasMore = true;

    function loadFiles() {
        if (isLoading || !hasMore) return;

        isLoading = true;
        const url = new URL(route('admin.books.select.files'));
        url.searchParams.append('search', searchInput.value);
        url.searchParams.append('page', page);
        url.searchParams.append('updating_book', updatingBookId);

        fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'x-csrf-token': csrfToken,
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    container.insertAdjacentHTML('beforeend', data.data);
                    enableRadioTogglingOnFileSelector();
                    page++;
                    hasMore = data.has_more;
                }
            })
            .catch(error => {
                console.error('Error:', error.message || error);
            })
            .finally(() => {
                isLoading = false;
            });
    }

    container.addEventListener('scroll', function () {
        if (container.scrollTop + container.clientHeight >= container.scrollHeight - 100) {
            loadFiles();
        }
    });

    searchInput.addEventListener('keyup', function () {
        page = 1;
        hasMore = true;
        container.innerHTML = '';
        loadFiles();
    });

    // loadFiles();


}

function editingBook() {
    coverImageDropzone.removeAllFiles(true);
    const coverImage = document.querySelector("#hiddenFileInput");

    if (coverImage) {

        const imageUrl = coverImage.getAttribute('data-cover-image');
        const imageSize = coverImage.getAttribute('data-cover-image-size');
        if (imageUrl) {
            const mockFile = { name: "Existing Image", size: 123456, type: "image/jpeg" };
            coverImageDropzone.emit("addedfile", mockFile);
            coverImageDropzone.emit("thumbnail", mockFile, imageUrl);
            coverImageDropzone.emit("complete", mockFile);

            mockFile.previewElement.querySelector(".dz-remove").addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                alert("Cannot remove the existing image!");
            });

            document.querySelector('.cover_file_input_dropzone .text-content .size').innerHTML = imageSize;
        }
    }

    const fileIdInput = document.querySelector("#selectedFileId");
    if (fileIdInput) {
        const fileId = fileIdInput.value;
        if (fileId) {
            const pickerTextContent = document.querySelector("#selectFilePickerText");
            const selectedPreview = document.querySelector('#selectedFilePreview');

            selectedPreview.querySelector(".file_name").innerHTML = fileIdInput.getAttribute('data-updating-book-filename');
            selectedPreview.querySelector(".size").innerHTML = fileIdInput.getAttribute('data-updating-book-size');


            if (pickerTextContent && !pickerTextContent.classList.contains('hide')) {
                pickerTextContent.classList.add('hide')
            }

            selectedPreview.querySelector(".close-btn").addEventListener('click', () => {
                document.querySelector("#selectedFileId").value = "";

                selectedPreview.classList.add('hide');
                if (pickerTextContent && pickerTextContent.classList.contains('hide')) {
                    pickerTextContent.classList.remove('hide')
                }
            });


            const extensionIcon = fileIdInput.getAttribute('data-updating-book-icon');
            selectedPreview.querySelector(".icon-container").innerHTML = `<i class="bi ${extensionIcon} icon-bg" id="extensionIcon"></i>`;

            selectedPreview.classList.remove('hide');

            // document.querySelectorAll("[name='file_id']").forEach(file => {
            //     if(file.getAttribute('value') == fileId){
            //         file.checked = true;
            //     }
            // });

        }
    }

}
