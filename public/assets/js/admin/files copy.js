const UPLOADS_KEY = '0x-uploading-file';

document.addEventListener('DOMContentLoaded', () => {

    let dropzone = document.querySelector(".upload_file_input_dropzone");
    dropzone.classList.add("dropzone-prime-selector-area");

    const dropzoneOptions = {
        url: "#!",
        acceptedFiles: "*/*",
        maxFilesize: 300,
        addRemoveLinks: true,
        dictDefaultMessage: "Drop files here or click to upload (multiple files allowed).",
        previewTemplate: document.querySelector("#dropzone-preview-list").outerHTML,
    };

    new DropZone().singleFileDropzone(dropzone, dropzoneOptions);
    init();
 });


 function init() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const fileUploadBtn = document.querySelector('#fileUploadBtn');

    fileUploadBtn.addEventListener('click', async () => {
        const fileUploadArea = document.querySelector('#uploadFileArea');
        const fileInput = fileUploadArea.querySelector('input[type="file"]');
        const file = fileInput.files[0];
        const key = new Date().getTime() + file.name;


        if(!file){
            alert('Please select a file to upload.');
            return;
        }

        const chunkSize = 1 * 1024 * 1024;
        const totalChunks = Math.ceil(file.size / chunkSize);

        if(totalChunks > 0){
            addToUploadingFiles(key);
        }

        let uploadedChunks = await fetch( route('admin.file.upload.status') + `?fileName=${encodeURIComponent(key)}`, {
            headers: {
                'Content-Type': 'application/json',
                'x-csrf-token': csrfToken
            },
        })
        .then((response) => response.json())
        .then((data) => data.uploadedChunks || [])
        .catch(() => []);


        const savedProgress = JSON.parse(localStorage.getItem(key)) || [];
        uploadedChunks = Array.from(new Set([...uploadedChunks, ...savedProgress]));

        let currentChunk = uploadedChunks.length;

        async function uploadChunk(){

            if (currentChunk >= totalChunks) {
                document.getElementById('uploadProgress').textContent = 'Upload Complete!';
                localStorage.removeItem(key);
                removeFromUploadingFiles(key);
                return;
            }

            const start = currentChunk * chunkSize;
            const end = Math.min(start + chunkSize, file.size);

            const chunk = file.slice(start, end);
            const formData = new FormData();
            formData.append('file', chunk);
            formData.append('chunkIndex', currentChunk);
            formData.append('totalChunks', totalChunks);
            formData.append('fileName', key);

            try {
                await fetch(route('admin.files.upload.chunk'), {
                    method: 'POST',
                    headers: {
                        'x-csrf-token': csrfToken
                    },
                    body: formData,
                });

                currentChunk++;

                uploadedChunks.push(currentChunk);
                localStorage.setItem(key, JSON.stringify(uploadedChunks));

                const progress = Math.round((currentChunk / totalChunks) * 100);
                document.getElementById('uploadProgress').textContent = `Progress: ${progress}%`;
                setTimeout(() => {
                    uploadChunk();
                }, 1000);
            } catch (error) {
                alert('An error occurred. Retrying...');
            }

        }

        uploadChunk();


    });
}

function addToUploadingFiles(key){
    console.log('add to upload files : ' + key);
    const savedUploadings = JSON.parse(localStorage.getItem(UPLOADS_KEY)) || [];
    const newUploadings = Array.from(new Set([...savedUploadings, key]));
    localStorage.setItem(UPLOADS_KEY, JSON.stringify(newUploadings));
}

function removeFromUploadingFiles(key) {
    const savedUploadings = JSON.parse(localStorage.getItem(UPLOADS_KEY)) || [];
    const updatedUploadings = savedUploadings.filter(item => item !== key);

    localStorage.removeItem(key);

    if (updatedUploadings.length > 0) {
      localStorage.setItem(UPLOADS_KEY, JSON.stringify(updatedUploadings));
    } else {
      localStorage.removeItem(UPLOADS_KEY);
    }
}


