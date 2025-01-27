let csrfToken = "";

document.addEventListener('DOMContentLoaded', () => {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    new DropZone().createSimpleSingleFileDropzone(".cover_file_input_dropzone");
    init();

    document.querySelector('.selectedFilePreview .text-content').addEventListener('click', (event) => {
        event.stopPropagation();
        console.log('stop propergation');
    });
    document.querySelector('.text-content').addEventListener('click', (event) => {
        event.stopPropagation();
        console.log('stop propergation');
    });

    document.querySelector('#selectFileModalOpener').addEventListener('click', function () {
        const modalElement = document.getElementById('selectFile');
        const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modal.show();
    });

});

function init() {
    enableQuillEditor("#quill-editor");

    enableRadioTogglingOnFileSelector();

    enableDynamicBranchAndSemester("#branch_selector", '#semester_selector');

    enableFileSearching("#searchFileInput", "#fileSelectionArea");

    bookSelection();
}

function enableQuillEditor(selector) {

    const quillEditorObj = new QuillEditor().getQuillEditorObject(selector);

    const form = document.getElementById('addBookForm');
    const description = document.getElementById('description');

    form.addEventListener('submit', function (event) {
        const htmlContent = quillEditorObj.root.innerHTML;
        description.value = htmlContent;
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

    let semesterChoices = new Choices(semesterSelect, {
        removeItemButton: true,
        searchEnabled: true,
    });

    branchSelect.addEventListener('change', () => {

        const branchId = branchSelect.value;
        const semesterId = semesterSelect.value;

        const url = new URL(route('api.fetch.semesters'));
        url.searchParams.append('branch_id', branchId);

        const resetSemesterChoices = (label) => {
            semesterChoices.clearStore();
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
                        console.log(data.data);
                        let isAlreadySelected = data.data.some(semester => semesterId == semester.id);

                        const choices = data.data.map((semester, index) => ({
                            value: semester.id,
                            label: `Semester ${index + 1} ➜ ${semester.name}`,
                            selected: (semesterId == semester.id)
                        }));

                        resetSemesterChoices('--select semester--');
                        semesterChoices.setChoices(choices, 'value', 'label', true);

                        if (isAlreadySelected) {
                            console.log('already selected! + ' + semesterId);
                            semesterChoices.setChoiceByValue(semesterId);
                            return;
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
    });


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


                if (!pickerTextContent.classList.contains('hide')) {
                    pickerTextContent.classList.add('hide')
                }

                selectedPreview.querySelector(".close-btn").addEventListener('click', () => {
                    document.querySelector("#selectedFileId").value = "";

                    selectedPreview.classList.add('hide');
                    if (pickerTextContent.classList.contains('hide')) {
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

