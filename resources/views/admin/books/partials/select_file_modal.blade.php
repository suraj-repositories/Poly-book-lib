<div class="modal fade select-file-modal" id="selectFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Select File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="search-box-container">
                    <i class='bx bx-search'></i>
                    <input type="text" name="search" id="searchFileInput" placeholder="search" class="form-control">
                </div>

                <div class="mb-2 file-selection-area" id="fileSelectionArea">
                      @include('admin.books.partials.selectable_files')
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="fileSelectionDoneBtn">Done</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelector('#file_id').addEventListener('change', function() {
        console.log(132);
    });
</script>
