let myDropzone = null;

document.addEventListener('DOMContentLoaded', () => {
    new DropZone().createSimpleSingleFileDropzone("#branchImageDropzone");
    myDropzone = new DropZone().createSimpleSingleFileDropzone("#branchEditImageDropzone");
});



// --------------------------------------------
// Handle edit branch logic
// --------------------------------------------


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
