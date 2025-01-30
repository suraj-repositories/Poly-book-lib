let myDropzone = null;
document.addEventListener('DOMContentLoaded', () => {

   new DropZone().createSimpleSingleFileDropzone(".create_semester_file_input_dropzone");
   myDropzone = new DropZone().createSimpleSingleFileDropzone(".edit_semester_file_input_dropzone");

});

function openEditSemesterModal(element) {
    const id = element.getAttribute('data-semester-id');
    const title = element.getAttribute('data-semester-title');
    const subTitle = element.getAttribute('data-semester-sub-title');
    const imageUrl = element.getAttribute('data-semester-image');

    const updateModal = document.querySelector("#updateSemesterModal");
    const form = updateModal.querySelector('form');
    form.action = form.action.replace(/\/\d*$/, "") + "/" + id;

    updateModal.querySelector('#semesterTitle').value = title;
    updateModal.querySelector('#semesterSubTitle').value = subTitle;


    myDropzone.removeAllFiles(true);

    if (imageUrl) {


        updateModal.querySelectorAll('.dz-image-preview').forEach(imgBox => {
            console.log("DELETED");
            imgBox.remove();
        });

        const mockFile = { name: "Existing Image", size: 123456, type: "image/jpeg" };
        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, imageUrl);
        myDropzone.emit("complete", mockFile);

       mockFile.previewElement.querySelector(".dz-remove").addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            alert("Cannot remove the existing image!");
        });
    }

    $("#updateSemesterModal").modal('show');
}
