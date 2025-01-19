@extends('admin.layout.layout')
@section('title', Route::is('admin.branches') ? 'File List' : '')
@section('content')

    <div class="container-fluid files">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div class="text-dark fs-3 fw-semibold d-flex align-items-center">
                                <iconify-icon icon="solar:file-broken"></iconify-icon>
                                &nbsp;Upload File
                            </div>
                            <div>
                                <a href="#!" class="btn btn-success">
                                    <i class='bx bx-list-ul me-1 fs-4'></i>Show Files
                                </a>
                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>

                <div class="card file-upload-card">
                    <div class="card-body">


                        <div class="mb-3 image-area" id="uploadFileArea">
                            <label for="filesUpload" class="form-label">Upload File</label>

                            <!-- Hidden input to store file data -->
                            <input type="file" name="file" id="hiddenFileInput" class="hidden">


                            <div class="dropzone dz-clickable upload_file_input_dropzone" id="branchImageDropzone">
                                <div class="dz-message needsclick">
                                    <i class="h1 bx bx-cloud-upload"></i>
                                    <h3>Drop files here or click to upload.</h3>
                                    <span class="text-muted fs-13">
                                        (This is just a demo dropzone. Selected files are
                                        <strong>not</strong> actually uploaded.)
                                    </span>
                                </div>
                            </div>

                            <ul class="list-unstyled mb-0" id="dropzone-preview" style="display: none;">
                                <li class="mt-2" id="dropzone-preview-list">
                                    <div class="border rounded">
                                        <div class="d-flex p-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm bg-light rounded">
                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="{{ config('constants.default_upload_file_dropzone_image') }}"
                                                        alt="Dropzone-Image" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="pt-1">
                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;
                                                    </h5>
                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                    {{-- <strong class="error text-danger" data-dz-errormessage></strong> --}}
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-3">
                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                            </div>

                                        </div>

                                    </div>
                                </li>
                            </ul>

                        </div>

                        <div class="d-flex">
                            <button type="button" class="btn btn-success ms-auto" id="fileUploadBtn">
                                Upload
                            </button>
                            <button type="button" id="restartButton">restart</button>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" id="uploadProgress">25%</div>
                        </div>

                    </div>
                </div>



                <div class="card upload-progress-card">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="upload-data">
                                <i class="bi bi-filetype-pdf"></i>
                                <div class="title-area">
                                    <div class="title">apps-invoices.html</div>
                                    <div class="sub-title"><span class="precentage">12% completed</span> <span
                                            class="divider">|</span> <span class="time">12:23 minutes remaining</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <div class="h-100 w-100 align-content-center me-1">
                                <div class="progress rounded-0">
                                    <div class="progress-bar bg-secondary progress-bar-striped progress-bar-animated"
                                        role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>

                            </div>
                            <form action="">
                                <button class="btn stop-upload p-0 m-0" type="submit">
                                    <iconify-icon class="text-success fs-2"
                                        icon="solar:pause-circle-bold-duotone"></iconify-icon>
                                </button>
                            </form>
                            <form action="">
                                <button class="btn stop-upload p-0 m-0" type="submit">
                                    <iconify-icon class="text-danger fs-2"
                                        icon="solar:close-circle-bold-duotone"></iconify-icon>
                                </button>
                            </form>
                        </div>
                    </div>




                </div>

            </div>

            <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->


    <script src="{{ asset('assets/js/admin/files.js') }}"></script>
@endsection
