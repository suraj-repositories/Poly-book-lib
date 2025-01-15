@extends('admin.layout.layout')
@section('title', Route::is('admin.semesters') ? 'Semesters List' : '')
@section('content')

    <div class="container-fluid semesters">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:floor-lamp-broken" class="me-1 pt-1"></iconify-icon>
                                Semesters
                            </div>
                            <div>
                                <a href="#!" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#createBranchModal">
                                    <i class="bx bx-plus me-1"></i>
                                    Create Semester
                                </a>

                                <div class="modal fade create-branch-modal" id="createBranchModal" tabindex="-1"
                                    aria-labelledby="createBranchModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.branches.store') }}" method="post"
                                                enctype="multipart/form-data" class="needs-validation">
                                                @csrf
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="createBranchModalLabel">Create New
                                                        Branch</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="branchName" class="form-label">Branch Name</label>

                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <iconify-icon icon="solar:book-broken"></iconify-icon>
                                                            </span>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter branch name..." id="branchName" name="name" required>
                                                                <div class="invalid-feedback">
                                                                    Please select a valid state.
                                                                  </div>

                                                        </div>
                                                    </div>

                                                    <div class="mb-3 image-area">
                                                        <label for="branchName" class="form-label">Branch Image</label>

                                                        <!-- Hidden input to store file data -->
                                                        <input type="file" name="image" id="hiddenFileInput"
                                                            class="hidden">


                                                        <div class="dropzone dz-clickable" id="branchImageDropzone">
                                                            <div class="dz-message needsclick">
                                                                <i class="h1 bx bx-cloud-upload"></i>
                                                                <h3>Drop files here or click to upload.</h3>
                                                                <span class="text-muted fs-13">
                                                                    (This is just a demo dropzone. Selected files are
                                                                    <strong>not</strong> actually uploaded.)
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <ul class="list-unstyled mb-0" id="dropzone-preview"
                                                            style="display: none;">
                                                            <li class="mt-2" id="dropzone-preview-list">
                                                                <div class="border rounded">
                                                                    <div class="d-flex p-2">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar-sm bg-light rounded">
                                                                                <img data-dz-thumbnail
                                                                                    class="img-fluid rounded d-block"
                                                                                    src="#" alt="Dropzone-Image" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <div class="pt-1">
                                                                                <h5 class="fs-14 mb-1" data-dz-name>&nbsp;
                                                                                </h5>
                                                                                <p class="fs-13 text-muted mb-0"
                                                                                    data-dz-size></p>
                                                                                <strong class="error text-danger hide"
                                                                                    data-dz-errormessage></strong>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-shrink-0 ms-3">
                                                                            <button data-dz-remove
                                                                                class="btn btn-sm btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>

                                                    </div>




                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Create New
                                                        Branch</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>




            </div>



            <!-- end card -->
        </div> <!-- end col -->

        <div class="row row-cols-md-2 row-cols-lg-3 row-cols-xl-3">

            @foreach ($semesters as $semester)
            <div class="col">

                    <div class="card semester-card">
                        <div class="card-body">
                            <div class="image-with-title">
                                @if($semester->image)
                                <img src="{{ $semester->getImageUrl() }}" alt="Semester-card-{{$loop->iteration}}">

                                @else
                                <div class="img-alt">  <iconify-icon icon="vscode-icons:folder-type-log-opened" ></iconify-icon>

                                @endif
                                </div>
                                <a href="">
                                    <div class="title-area">
                                        <div class="title">{{ $semester->name }}</div>
                                        <div class="sub-title">{{ $semester->duration }}</div>
                                    </div>
                                </a>
                            </div>

                            <div class="actions">

                                <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i></button>

                                <form action="">
                                    <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>

                                </form>
                            </div>
                        </div>
                    </div>

            </div>
            @endforeach


        </div>

    </div> <!-- end row -->


    <!-- update semester modal -->

    <div class="modal fade create-semester-modal" id="updateBranchModal" tabindex="-1"
        aria-labelledby="updateBranchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.branches.update', "") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateBranchModalLabel">Edit
                            Branch</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body branches">


                        <div class="mb-3">
                            <label for="branchName" class="form-label">Branch Name</label>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <iconify-icon icon="solar:book-broken"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" placeholder="Enter branch name..." id="branchName"
                                    name="name">
                            </div>
                        </div>


                        <div class="mb-3 image-area">
                            <label for="branchName" class="form-label">Branch Image</label>

                            <!-- Hidden input to store file data -->
                            <input type="file" name="image" id="hiddenFileInput"
                                class="hidden">

                        <div class="dropzone dz-clickable" id="branchEditImageDropzone">
                            <div class="dz-message needsclick">
                                <i class="h1 bx bx-cloud-upload"></i>
                                <h3>Drop files here or click to upload.</h3>
                                <span class="text-muted fs-13">(This is just a demo dropzone.)</span>
                            </div>
                        </div>

                        <ul id="dropzone-preview" style="display: none;">
                            <li id="dropzone-preview-template">
                                <div class="border rounded">
                                    <div class="d-flex p-2">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm bg-light rounded">
                                                <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Dropzone-Image">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 data-dz-name>&nbsp;</h5>
                                            <p data-dz-size class="text-muted"></p>
                                            <strong data-dz-errormessage class="error text-danger hide"></strong>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <button data-dz-remove class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update
                            Branch</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/admin/semesters.js') }}"></script>
@endsection
