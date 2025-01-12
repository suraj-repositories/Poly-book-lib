document.addEventListener('DOMContentLoaded', () => {

    Dropzone.autoDiscover = false;

    const myDropzone = new Dropzone("#myDropzone", {
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
                    errorMessage = errorMessage.message || JSON.stringify(errorMessage); // Handle object case
                }

                const errorMessageElement = file.previewElement.querySelector('.error');
                if (errorMessageElement) {
                    errorMessageElement.textContent = errorMessage; // Display error message in preview
                }
            });

            this.on("success", function (file, response) {
                console.log("Success:", response);
            });
        }
    });

    // Custom CSS for Dropzone styling
    const myDropzoneElement = document.getElementById('myDropzone');
    myDropzoneElement.style.border = '2px dashed #ccc';
    myDropzoneElement.style.padding = '20px';
    myDropzoneElement.style.borderRadius = '5px';

    // Style the message area within Dropzone
    const messageArea = myDropzoneElement.querySelector('.dz-message');
    messageArea.style.textAlign = 'center';

    let form = myDropzoneElement.closest('form');
    if(form){
        form.addEventListener('submit', (event)=>{
            event.preventDefault();


            const files = myDropzone.getAcceptedFiles();
            if (files.length > 0) {
                const hiddenFileInput = document.getElementById("hiddenFileInput");

                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(files[0]);
                hiddenFileInput.files = dataTransfer.files;

                form.submit();

            }
        });
    }
});
