@extends('admin.layout.layout')
@section('title', Route::is('admin.branches') ? 'Branch List' : '')
@section('content')

    <div class="container-fluid branches">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:floor-lamp-broken" class="me-1 pt-1"></iconify-icon>
                                Branches
                            </div>
                            <div>
                                <a href="#!" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#createBranchModal">
                                    <i class="bx bx-plus me-1"></i>Create Branch
                                </a>

                                <div class="modal fade create-branch-modal" id="createBranchModal" tabindex="-1"
                                    aria-labelledby="createBranchModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
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


                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <div class="mb-3">
                                                                <label for="branchName" class="form-label">Branch
                                                                    Name</label>

                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <iconify-icon
                                                                            icon="solar:book-broken"></iconify-icon>
                                                                    </span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter branch name..." id="branchName"
                                                                        name="name" required>

                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Invalid input!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="mb-3">
                                                                <label for="branchName" class="form-label">Semesters</label>

                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">
                                                                        <iconify-icon
                                                                            icon="solar:calendar-minimalistic-broken"></iconify-icon>

                                                                    </span>
                                                                    <select class="form-select" name="semester_id">
                                                                        <option selected value="">Decide later
                                                                        </option>
                                                                        @foreach ($semesters as $semester)
                                                                            <option value="{{ $semester->id }}">
                                                                                {{ $loop->iteration }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="input-group-text">semesters</span>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Invalid input!
                                                                </div>
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
                                                                    (Select the image that represents the branch to upload.)
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

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-centered" data-table="true">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault5">
                                            </div>
                                        </th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Branch</th>
                                        <th scope="col">Semesters</th>
                                        <th scope="col">Books</th>
                                        <th scope="col">Last Updated</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($branches as $branch)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="check-selectpr">
                                                </div>
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $branch->getImageUrl() }}" alt=""
                                                        class="avatar-xs rounded-circle me-2">
                                                    <div>
                                                        <h5 class="fs-14 m-0 fw-normal">{{ $branch->name }}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($branch->semestersCount() == 0)
                                                    <small class="soft-danger">Not decided yet.</small>
                                                @else
                                                    {{ $branch->semestersCount() }}
                                                @endif
                                            </td>
                                            <td>1</td>
                                            <td> {{ date('d M, Y', strtotime($branch->created_at)) }}
                                                <small>{{ date('h:i A', strtotime($branch->created_at)) }}</small>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-sm btn-soft-secondary me-1"
                                                    onclick="openEditBranchModal(this)"
                                                    data-branch-id="{{ $branch->id }}"
                                                    data-branch-name="{{ $branch->name }}"
                                                    data-branch-image="{{ $branch->getImageUrl() }}"
                                                    data-branch-semesters="{{ $branch->semestersCount() }}">
                                                    <i class="bx bx-edit fs-16"></i>
                                                </button>
                                                <form action="{{ route('admin.branches.destroy', $branch->id) }}"
                                                    class="d-inline" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger"><i
                                                            class="bx bx-trash fs-16"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- update branch modal -->

    <div class="modal fade create-branch-modal" id="updateBranchModal" tabindex="-1"
        aria-labelledby="updateBranchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.branches.update', '') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateBranchModalLabel">Edit
                            Branch</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body branches">

                        <div class="row">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="branchName" class="form-label">Branch Name</label>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <iconify-icon icon="solar:book-broken"></iconify-icon>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Enter branch name..."
                                            id="branchName" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="semesterId" class="form-label">Semesters</label>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <iconify-icon icon="solar:calendar-minimalistic-broken"></iconify-icon>

                                        </span>
                                        <select class="form-select" name="semester_id" id="semesterId">

                                            <option selected value="" class="decide_later_option">Decide later</option>

                                            @foreach ($semesters as $semester)
                                                <option value="{{ $semester->id }}">{{ $loop->iteration }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text">semesters</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Invalid input!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 image-area">
                            <label for="branchName" class="form-label">Branch Image</label>

                            <!-- Hidden input to store file data -->
                            <input type="file" name="image" id="hiddenFileInput" class="hidden">

                            <div class="dropzone dz-clickable" id="branchEditImageDropzone">
                                <div class="dz-message needsclick">
                                    <i class="h1 bx bx-cloud-upload"></i>
                                    <h3>Drop files here or click to upload.</h3>
                                    <span class="text-muted fs-13">(Select the image that represents the branch to upload.)</span>
                                </div>
                            </div>

                            <ul id="dropzone-preview" style="display: none;">
                                <li id="dropzone-preview-template">
                                    <div class="border rounded">
                                        <div class="d-flex p-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm bg-light rounded">
                                                    <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                        src="#" alt="Dropzone-Image">
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

    <script src="{{ asset('assets/js/admin/branches.js') }}"></script>
@endsection
