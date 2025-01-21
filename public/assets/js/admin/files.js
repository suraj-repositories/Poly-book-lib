document.addEventListener('beforeunload', function(e) {
    const uploadingFiles = JSON.parse(localStorage.getItem('resumable-uploads')) || [];
    if (uploadingFiles.length > 0) {
        e.preventDefault();
        e.returnValue = "You have ongoing file uploads. Leaving this page will cancel them.";
    }
});

let uploadDropzone = null;
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

    uploadDropzone = new DropZone().singleFileDropzone(dropzone, dropzoneOptions);
    init();
});

function init() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const fileUploadBtn = document.querySelector('#fileUploadBtn');

    fileUploadBtn.addEventListener('click', async () => {


        const fileInput = document.querySelector('#uploadFileArea input[type="file"]');
        const file = fileInput.files[0];

        if (!file) {
            alert('Please select a file to upload.');
            return;
        }
        emptyFileSelection();

        const key = new Date().getTime() + file.name;
        await uploadFile(file, key, csrfToken);
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
    if (currentChunk > 0) {
        addToUploadingFiles(key);
    }

    let progressBar = createProgressBar(key, file, uploadedChunks, totalChunks);

    const uploadChunk = async (index) => {
        if (uploadedChunks.includes(index) || index >= totalChunks) return;

        console.log("progress bar : ", progressBar);
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
                await delay(2000);

                const response = await fetch(route('admin.files.upload.chunk'), {
                    method: 'POST',
                    headers: { 'x-csrf-token': csrfToken },
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error(`Upload chunk ${index} failed with status ${response.status}`);
                }

                uploadedChunks.push(index);
                localStorage.setItem(key, JSON.stringify(uploadedChunks));

                updateProgressBar(progressBar, file, uploadedChunks, totalChunks);

                if (uploadedChunks.length === totalChunks) {
                    onCompleteUpload(key, progressBar);
                }

                return;
            } catch (error) {
                retryCount++;
                console.warn(`Retrying chunk ${index}... (${retryCount}/${maxRetries})`, error);
                await delay(2000);
            }
        }

        alert(`Failed to upload chunk ${index} after ${maxRetries} attempts.`);
    };

    const uploadChunksInParallel = async () => {
        const promises = [];
        for (let i = 0; i < maxParallelUploads; i++) {
            promises.push(processNextChunk(i));
        }
        await Promise.all(promises);
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


function createProgressBar(key, file, uploadedChunks, totalChunks) {
    const template = document.getElementById("file-progress-template");
    const uploadProgress = template.content.cloneNode(true);

    const fileService = new FileService(file);

    const progressBarId = `progress-` + Utility.createUUID();

    uploadProgress.querySelector('.upload-progress-card').id = progressBarId;
    uploadProgress.querySelector('#file_name').innerHTML = fileService.getName();
    uploadProgress.querySelector('#time_remaining').innerHTML = "time calculating...";
    uploadProgress.querySelector('#completed_percentage').innerHTML = "0% Completed";
    uploadProgress.querySelector('#progress_bar').style.width = "0%";
    uploadProgress.querySelector('#progress_bar').textContent = "%";
    uploadProgress.querySelector('#file_icon').classList.add(fileService.getIconFromExtension(fileService.getExtension()));

    const container = document.querySelector("#processing_files");
    const appendedElement = container.appendChild(uploadProgress);

    // Return the appended element
    console.log(uploadProgress, document.querySelector(`#${progressBarId}`));
    return container.querySelector(`#${progressBarId}`);
}


function updateProgressBar(progressBar, file, uploadedChunks, totalChunks) {
    if (!progressBar) {
        console.error('Progress bar element not found');
        return;
    }

    const progress = Math.round((uploadedChunks.length / totalChunks) * 100);

    progressBar.querySelector('#progress_bar').style.width = `${progress}%`;
    progressBar.querySelector('#progress_bar').textContent = `${progress}%`;
    progressBar.querySelector('#completed_percentage').innerHTML = `${progress}% Completed`;

    const fileService = new FileService();
    progressBar.querySelector('#time_remaining').innerHTML = fileService.getSize(file);
}


function onCompleteUpload(key, progressBar) {
    localStorage.removeItem(key);
    removeFromUploadingFiles(key);
    setTimeout(() => {
        progressBar.remove();
    }, 2000);
}

function addToUploadingFiles(key) {
    const savedUploadings = JSON.parse(localStorage.getItem('resumable-uploads')) || [];
    const newUploadings = Array.from(new Set([...savedUploadings, key]));
    localStorage.setItem('resumable-uploads', JSON.stringify(newUploadings));
}

function removeFromUploadingFiles(key) {
    const savedUploadings = JSON.parse(localStorage.getItem('resumable-uploads')) || [];
    const updatedUploadings = savedUploadings.filter(item => item !== key);

    if (updatedUploadings.length > 0) {
        localStorage.setItem('resumable-uploads', JSON.stringify(updatedUploadings));
    } else {
        localStorage.removeItem('resumable-uploads');
    }
}

function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function emptyFileSelection(){
    const uploadArea = document.querySelector("#uploadFileArea");
    const hiddenFileInput = uploadArea.querySelector("input[type='file']");
    uploadDropzone.removeAllFiles(true);
    let dataTransfer = new DataTransfer();
    hiddenFileInput.files = dataTransfer.files;
}
