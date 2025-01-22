const UPLOADING_FILES_KEY = '0x-uploading-file';
const UPLOAD_CHUNK_SIZE = 1 * 1024 * 1024;

let uploadChunkTimes = {};

window.addEventListener("beforeunload", (e) => {
    const inProgress = localStorage.getItem(UPLOADING_FILES_KEY) ?? null;
    if (inProgress) {
        e.preventDefault();
        if (!confirm("Running... Leave?")) e.preventDefault();
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
    emptyUploadHistoryFormLocal();
    init();
});

function emptyUploadHistoryFormLocal() {
    let uploadkeys = JSON.parse(localStorage.getItem(UPLOADING_FILES_KEY)) ?? [];
    if (uploadkeys.length > 0) {
        uploadkeys.forEach(key => {
            if (localStorage.getItem(key) !== null) {
                localStorage.removeItem(key);
            }
        });
    }
    if (localStorage.getItem(UPLOADING_FILES_KEY) !== null) {
        localStorage.removeItem(UPLOADING_FILES_KEY);
    }
}

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

        const key = new Date().getTime() + "_x_" + file.name;
        await uploadFile(file, key, csrfToken);
    });
}

async function uploadFile(file, key, csrfToken) {

    uploadChunkTimes[key] = [];

    const totalChunks = Math.ceil(file.size / UPLOAD_CHUNK_SIZE);
    const maxParallelUploads = 3;

    let uploadedChunks = await getUploadedChunks(key, csrfToken);
    const savedProgress = JSON.parse(localStorage.getItem(key)) || [];
    uploadedChunks = Array.from(new Set([...uploadedChunks, ...savedProgress]));

    let currentChunk = uploadedChunks.length;
    console.log(currentChunk);
    addToUploadingFiles(key);

    let progressBar = createProgressBar(key, file, uploadedChunks, totalChunks);

    const uploadChunk = async (index) => {
        if (uploadedChunks.includes(index) || index >= totalChunks) return;

        console.log("progress bar : ", progressBar);
        const start = index * UPLOAD_CHUNK_SIZE;
        const end = Math.min(start + UPLOAD_CHUNK_SIZE, file.size);
        const chunk = file.slice(start, end);
        const formData = new FormData();
        formData.append('file', chunk);
        formData.append('chunkIndex', index);
        formData.append('totalChunks', totalChunks);
        formData.append('fileName', key);

        let retryCount = 0;
        const maxRetries = 3;

        while (retryCount < maxRetries) {

            const startTime = performance.now();

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

                updateProgressBar(key, progressBar, file, uploadedChunks, totalChunks);

                if (uploadedChunks.length === totalChunks) {
                    onCompleteUpload(key, progressBar);
                }

                const endTime = performance.now();
                const chunkUploadTime = (endTime - startTime) / 1000;

                uploadChunkTimes[key].push(chunkUploadTime);

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
async function cancelUploading(key, csrfToken){
    try{
        const response = await fetch(route('admin.files.upload.cancel'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'x-csrf-token': csrfToken
            },
            body: JSON.stringify({ fileName: key }),
        });
        const data = await response.json();
        return data.success || false;
    }catch(error){
        console.error('Failed to cancel uploading: ', error);
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
    uploadProgress.querySelector('#file_size').innerHTML = "calculating...";
    uploadProgress.querySelector('#progress_bar').style.width = "0%";
    uploadProgress.querySelector('#progress_bar').textContent = "%";
    uploadProgress.querySelector('#file_icon').classList.add(fileService.getIconFromExtension(fileService.getExtension()));

    const container = document.querySelector("#processing_files");
    const appendedElement = container.appendChild(uploadProgress);

    let cancelBtn = container.querySelector('#stop-upload');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(cancelBtn, uploadProgress, cancelBtn);
    cancelBtn.addEventListener('click', async ()=>{
        const response = await cancelUploading(key, csrfToken);

        console.log('stoped : ' , response);
        // removeFromUploadingFiles(key);
        // uploadProgress.remove();
    });

    console.log(uploadProgress, document.querySelector(`#${progressBarId}`));
    return container.querySelector(`#${progressBarId}`);
}


function updateProgressBar(key, progressBar, file, uploadedChunks, totalChunks) {
    if (!progressBar) {
        console.error('Progress bar element not found');
        return;
    }

    const progress = Math.round((uploadedChunks.length / totalChunks) * 100);


    const fileService = new FileService();
    progressBar.querySelector('#progress_bar').style.width = `${progress}%`;
    progressBar.querySelector('#progress_bar').textContent = `${progress}%`;
    progressBar.querySelector('#completed_percentage').innerHTML = `${progress}% Completed`;
    progressBar.querySelector('#file_size').innerHTML = fileService.getSize(file);

    let secondsToComplete = calculateAverageUploadTimeForFile(key, uploadedChunks, totalChunks);
    const readableTime = Utility.formatTimeFromSeconds(secondsToComplete);

    progressBar.querySelector('#time_remaining').innerHTML = readableTime;
}

function calculateAverageUploadTimeForFile(fileName, uploadedChunks, totalChunks) {

    console.log(fileName, totalChunks, uploadedChunks);
    if (!uploadChunkTimes.hasOwnProperty(fileName)) {
        console.error(`File "${fileName}" not found in uploadTimes.`);
        return null;
    }

    const fileUploadTimes = uploadChunkTimes[fileName];
    const averageUploadTime = fileUploadTimes.reduce((sum, time) => sum + time, 0) / fileUploadTimes.length;
    const timeToComplete = (totalChunks * averageUploadTime) - (uploadedChunks.length * averageUploadTime);
    return timeToComplete.toFixed();
}

function onCompleteUpload(key, progressBar) {

    removeFromUploadingFiles(key);
    setTimeout(() => {
        progressBar.remove();
    }, 1000);
}

function addToUploadingFiles(key) {
    const savedUploadings = JSON.parse(localStorage.getItem(UPLOADING_FILES_KEY)) || [];
    const newUploadings = Array.from(new Set([...savedUploadings, key]));
    console.log('adding to upload files : -------------+-------------');
    localStorage.setItem(UPLOADING_FILES_KEY, JSON.stringify(newUploadings));
}

function removeFromUploadingFiles(key) {
    localStorage.removeItem(key);

    const savedUploadings = JSON.parse(localStorage.getItem(UPLOADING_FILES_KEY)) || [];
    const updatedUploadings = savedUploadings.filter(item => item !== key);

    console.log("------------------------------------------------local host : ", savedUploadings);
    if (updatedUploadings.length > 0) {
        localStorage.setItem(UPLOADING_FILES_KEY, JSON.stringify(updatedUploadings));
    } else {
        localStorage.removeItem(UPLOADING_FILES_KEY);
    }
}

function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function emptyFileSelection() {
    const uploadArea = document.querySelector("#uploadFileArea");
    const hiddenFileInput = uploadArea.querySelector("input[type='file']");
    uploadDropzone.removeAllFiles(true);
    let dataTransfer = new DataTransfer();
    hiddenFileInput.files = dataTransfer.files;
}
