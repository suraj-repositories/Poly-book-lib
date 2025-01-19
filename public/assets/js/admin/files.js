const UPLOADS_KEY = '0x-uploading-file';

document.addEventListener('DOMContentLoaded', () => {
    const dropzone = document.querySelector(".upload_file_input_dropzone");
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

    fileUploadBtn.addEventListener('click', () => {
        const fileInput = document.querySelector('#uploadFileArea input[type="file"]');
        const file = fileInput.files[0];

        if (!file) {
            alert('Please select a file to upload.');
            return;
        }

        const key = new Date().getTime() + file.name;
        uploadFile(file, key, csrfToken);
    });
}

async function uploadFile(file, key, csrfToken) {
    const chunkSize = 1 * 1024 * 1024;
    const totalChunks = Math.ceil(file.size / chunkSize);
    const maxParallelUploads = 3;
    let uploadedChunks = await getUploadedChunks(key, csrfToken);
    const savedProgress = JSON.parse(localStorage.getItem(key)) || [];
    uploadedChunks = Array.from(new Set([...uploadedChunks, ...savedProgress]));

    let currentChunk = uploadedChunks.length;
    if (currentChunk > 0) addToUploadingFiles(key);

    const progressBar = createProgressBar(key);

    const uploadChunk = async (index) => {
        if (uploadedChunks.includes(index) || index >= totalChunks) return;

        const start = index * chunkSize;
        const end = Math.min(start + chunkSize, file.size);
        const chunk = file.slice(start, end);
        const formData = new FormData();
        formData.append('file', chunk);
        formData.append('chunkIndex', index);
        formData.append('totalChunks', totalChunks);
        formData.append('fileName', key);

        let retryCount = 0;
        const maxRetries = 3;

        while (retryCount < maxRetries) {
            try {

                await delay(1000);

                await fetch(route('admin.files.upload.chunk'), {
                    method: 'POST',
                    headers: { 'x-csrf-token': csrfToken },
                    body: formData,
                });
                uploadedChunks.push(index);
                localStorage.setItem(key, JSON.stringify(uploadedChunks));

                const progress = Math.round((uploadedChunks.length / totalChunks) * 100);
                progressBar.style.width = `${progress}%`;
                progressBar.textContent = `Progress: ${progress}%`;

                if (uploadedChunks.length === totalChunks) {
                    onCompleteUpload(key, progressBar);
                }

                return;
            } catch (error) {
                retryCount++;
                console.warn(`Retrying chunk ${index}... (${retryCount}/${maxRetries})`);
                await delay(1000);
                await new Promise(res => setTimeout(res, 1000));
            }
        }

        alert(`Failed to upload chunk ${index} after ${maxRetries} attempts.`);
    };

    const uploadChunksInParallel = () => {
        const promises = [];
        for (let i = 0; i < maxParallelUploads; i++) {
            promises.push(processNextChunk(i));
        }
        return Promise.all(promises);
    };

    async function processNextChunk(startIndex) {
        for (let i = startIndex; i < totalChunks; i += maxParallelUploads) {
            await uploadChunk(i);
        }
    }

    uploadChunksInParallel();
}

async function getUploadedChunks(fileName, csrfToken) {
    try {
        const response = await fetch(route('admin.file.upload.status') + `?fileName=${encodeURIComponent(fileName)}`, {
            headers: { 'Content-Type': 'application/json', 'x-csrf-token': csrfToken },
        });
        const data = await response.json();
        return data.uploadedChunks || [];
    } catch (error) {
        console.error('Failed to fetch uploaded chunks:', error);
        return [];
    }
}

function createProgressBar(key) {
    const progressContainer = document.getElementById('uploadProgressContainer') || document.body;
    const progressBar = document.createElement('div');
    progressBar.classList.add('upload-progress-bar');
    progressBar.id = `progress-${key}`;
    progressBar.style.width = '0%';
    progressBar.style.height = '20px';
    progressBar.style.backgroundColor = 'green';
    progressBar.style.marginBottom = '10px';
    progressBar.style.color = '#fff';
    progressBar.style.textAlign = 'center';
    progressContainer.appendChild(progressBar);
    return progressBar;
}

function onCompleteUpload(key, progressBar) {
    progressBar.style.backgroundColor = 'blue';
    progressBar.textContent = 'Upload Complete!';
    localStorage.removeItem(key);
    removeFromUploadingFiles(key);
}

function addToUploadingFiles(key) {
    const savedUploadings = JSON.parse(localStorage.getItem(UPLOADS_KEY)) || [];
    const newUploadings = Array.from(new Set([...savedUploadings, key]));
    localStorage.setItem(UPLOADS_KEY, JSON.stringify(newUploadings));
}

function removeFromUploadingFiles(key) {
    const savedUploadings = JSON.parse(localStorage.getItem(UPLOADS_KEY)) || [];
    const updatedUploadings = savedUploadings.filter(item => item !== key);

    if (updatedUploadings.length > 0) {
        localStorage.setItem(UPLOADS_KEY, JSON.stringify(updatedUploadings));
    } else {
        localStorage.removeItem(UPLOADS_KEY);
    }
}

function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
