
document.addEventListener('DOMContentLoaded', ()=>{
    new DropZone().createSimpleSingleFileDropzone(".cover_file_input_dropzone");
    init();
});

function init(){
    enableRadioTogglingOnFileSelector();
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


