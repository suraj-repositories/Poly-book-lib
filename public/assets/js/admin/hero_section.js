let csrfToken = "";
let heroImageDropzone = null;
let aboutImageDropzone = null;

document.addEventListener('DOMContentLoaded', () => {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    heroImageDropzone = new DropZone().createSimpleSingleFileDropzone(".hero_image_input_dropzone");
    aboutImageDropzone = new DropZone().createSimpleSingleFileDropzone(".about_image_input_dropzone");

    editHeroSectionImage();
    editAboutImage();

});

function editHeroSectionImage() {

    // displaying : hero section image on edit
    aboutImageDropzone.removeAllFiles(true);
    const aboutImage = document.querySelector('[name="about_image"]');

    if (aboutImage) {

        const imageUrl = aboutImage.getAttribute('data-about-image');
        const imageSize = aboutImage.getAttribute('data-about-image-size');
        console.log(aboutImage, imageUrl, imageSize);
        if (imageUrl) {
            const mockFile = { name: "Existing Image", size: 123456, type: "image/jpeg" };
            aboutImageDropzone.emit("addedfile", mockFile);
            aboutImageDropzone.emit("thumbnail", mockFile, imageUrl);
            aboutImageDropzone.emit("complete", mockFile);

            mockFile.previewElement.querySelector(".dz-remove").addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                alert("Cannot remove the existing image!");
            });

            document.querySelector('.about_image_input_dropzone .text-content .size').innerHTML = imageSize;
        }
    }

}
function editAboutImage(){

    // displaying : about image on edit

    heroImageDropzone.removeAllFiles(true);
    const heroImage = document.querySelector('[name="hero_image"]');

    if (heroImage) {

        const imageUrl = heroImage.getAttribute('data-hero-image');
        const imageSize = heroImage.getAttribute('data-hero-image-size');
        console.log(heroImage, imageUrl, imageSize);
        if (imageUrl) {
            const mockFile = { name: "Existing Image", size: 123456, type: "image/jpeg" };
            heroImageDropzone.emit("addedfile", mockFile);
            heroImageDropzone.emit("thumbnail", mockFile, imageUrl);
            heroImageDropzone.emit("complete", mockFile);

            mockFile.previewElement.querySelector(".dz-remove").addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                alert("Cannot remove the existing image!");
            });

            document.querySelector('.hero_image_input_dropzone .text-content .size').innerHTML = imageSize;
        }
    }
}
