document.addEventListener('DOMContentLoaded', () => {

    Dropzone.autoDiscover = false;

    const myDropzone = new Dropzone("#branchImageDropzone", {
        url: "/upload",
        acceptedFiles: "image/*",
        maxFilesize: 2,
        addRemoveLinks: true,
        dictDefaultMessage: "Drop files here or click to upload.",
        previewTemplate: document.querySelector("#dropzone-preview-list").outerHTML,
        init: function () {
            this.on("addedfile", function (file) {
                console.log("File added:", file);
            });

            this.on("error", function (file, errorMessage) {
                if (typeof errorMessage === "object" && errorMessage !== null) {
                    errorMessage = errorMessage.message || JSON.stringify(errorMessage);
                }

                const errorMessageElement = file.previewElement.querySelector('.error');
                if (errorMessageElement) {
                    errorMessageElement.textContent = errorMessage;
                }
            });

            this.on("success", function (file, response) {
                console.log("Success:", response);
            });
        }
    });


    const myDropzoneElement = document.getElementById('branchImageDropzone');
    myDropzoneElement.style.border = '2px dashed #ccc';
    myDropzoneElement.style.padding = '20px';
    myDropzoneElement.style.borderRadius = '5px';


    const messageArea = myDropzoneElement.querySelector('.dz-message');
    messageArea.style.textAlign = 'center';

    let form = myDropzoneElement.closest('form');
    if (form) {
        form.addEventListener('submit', (event) => {
            event.preventDefault();

            const files = myDropzone.getAcceptedFiles();
            if (files.length > 0) {
                const hiddenFileInput = document.getElementById("hiddenFileInput");

                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(files[0]);
                hiddenFileInput.files = dataTransfer.files;


            }
            form.submit();
        });
    }
});


// ----------------------------------------------------------
// START - SHOW BRANCHES TABLE
// ----------------------------------------------------------
const tableConfigurations = {
    branchTable: {
        columns: [
            {
                name: "S.NO",
                formatter: (index) => {

                    return index;
                }
            },
            {
                name: "Branch",
                formatter: (_, row) => {
                    const branch = row.cells[1].data[0];
                    const imageUrl = row.cells[1].data[1];

                    return gridjs.html(`
                        <div class="d-flex align-items-center">
                            <img src="${imageUrl}" alt="${branch}" class="avatar-xs rounded-circle me-2">
                            <div>
                                <h5 class="fs-14 m-0 fw-normal">${branch}</h5>
                            </div>
                        </div>
                    `);
                }
            },
            { name: "Books" },
            { name: "Date",

                formatter:(_, row, cell)=>{
                    const data = row.cells[3].data;
                    const date = new Date(data);
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    return gridjs.html(
                        `${date.toLocaleDateString('en-US', options)}
                        <small> ${date.toLocaleTimeString('en-US', { hour: 'numeric', hour12: true, minute: '2-digit' }).toUpperCase()}</small>`);
                }
             },
            {
                name: "Action",
                formatter: (_, row) => {
                    const id = row.cells[0].data;

                    let buttonHTML = `<button type="submit" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>`;

                    const form = Form.getFormWithButton(route('admin.branches.destroy', {id:id}), "DELETE", buttonHTML);
                    form.classList.add('d-inline');
                    return gridjs.html(`
                        <a class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i></a>
                        ${form.outerHTML}
                    `);
                }
            }
        ],
        pagination: { limit: 10 },
        sort: true,
        search: true,

        data: () => {
            return fetch(route('api.fetch.branches'))
                .then((response) => response.json())
                .then((data) => {
                    return data['data'].map((branch) => [
                        branch.id,
                        [branch.name, branch.image],
                        1,
                       branch.created_at,

                    ]);
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                    return [];
                });
        }
    }
};

document.querySelectorAll(".table-gridjs").forEach((element) => {
    const tableId = element.getAttribute("data-id");
    if (!tableId || !tableConfigurations[tableId]) return;

    const config = tableConfigurations[tableId];

    element.innerHTML = "";
    new gridjs.Grid(config).render(element);
});

// --------------------------------------------
// Handle edit branch logic
// --------------------------------------------
let myDropzone = null;

document.addEventListener('DOMContentLoaded', () => {
    const dropzoneElement = document.querySelector("#branchEditImageDropzone");


    myDropzone = new Dropzone("#branchEditImageDropzone", {
        url: "/upload",
        acceptedFiles: "image/*",
        maxFilesize: 2,
        addRemoveLinks: true,
        dictDefaultMessage: "Drop files here or click to upload.",
        previewTemplate: document.querySelector("#dropzone-preview-template").outerHTML,
        init: function () {
            this.on("addedfile", function (file) {

                console.log(dropzoneElement.querySelectorAll('.dz-image-preview').length);
                dropzoneElement.querySelectorAll('.dz-image-preview').forEach(imgBox => {
                    imgBox.remove();

                     if (myDropzone.files.length > 1) {
                        myDropzone.removeAllFiles(true);
                        myDropzone.addFile(file);
                    }
                });

                console.log("File added:", file);
            });

            this.on("error", function (file, errorMessage) {
                const errorMessageElement = file.previewElement.querySelector('.error');
                if (errorMessageElement) {
                    errorMessageElement.textContent = errorMessage;
                }
            });

            this.on("success", function (file, response) {
                console.log("Success:", response);
            });
        }
    });

    // Optional: Style the Dropzone area
    dropzoneElement.style.border = '2px dashed #ccc';
    dropzoneElement.style.padding = '20px';
    dropzoneElement.style.borderRadius = '5px';

    const messageArea = dropzoneElement.querySelector('.dz-message');
    messageArea.style.textAlign = 'center';

    let form = dropzoneElement.closest('form');
    if (form) {
        form.addEventListener('submit', (event) => {
            event.preventDefault();

            const files = myDropzone.getAcceptedFiles();
            if (files.length > 0) {
                const hiddenFileInput = form.querySelector("#hiddenFileInput");


                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(files[0]);
                hiddenFileInput.files = dataTransfer.files;


            }
            form.submit();
        });
    }
});


function openEditBranchModal(element) {
    const id = element.getAttribute('data-branch-id');
    const name = element.getAttribute('data-branch-name');
    const imageUrl = element.getAttribute('data-branch-image');
    const semesters = element.getAttribute('data-branch-semesters');

    const updateModal = document.querySelector("#updateBranchModal");
    const form = updateModal.querySelector('form');
    form.action = form.action.replace(/\/\d*$/, "") + "/" + id;

    updateModal.querySelector('#branchName').value = name;

    if(semesters != 0){
        const decideLaterOption = form.querySelector('.decide_later_option');
        decideLaterOption.disabled = true;
        decideLaterOption.value = "";
    }
    updateModal.querySelector('#semesterId').value = semesters == 0 ? "" : semesters;

    myDropzone.removeAllFiles(true);

    if (imageUrl) {


        updateModal.querySelectorAll('.dz-image-preview').forEach(imgBox => {
            console.log("DELETED");
            imgBox.remove();
        });

        const mockFile = { name: "Existing Image", size: 123456, type: "image/jpeg" }; // Replace with actual file type if known
        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, imageUrl);
        myDropzone.emit("complete", mockFile);

       mockFile.previewElement.querySelector(".dz-remove").addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            alert("Cannot remove the existing image!");
        });
    }

    $("#updateBranchModal").modal('show');
}
