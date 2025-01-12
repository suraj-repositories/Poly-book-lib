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
                            <div class="search-bar">
                                <span><i class="bx bx-search-alt"></i></span>
                                <input type="search" class="form-control" id="search" placeholder="Search invoice...">
                            </div>
                            <div>
                                <a href="#!" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#createBranchModal">
                                    <i class="bx bx-plus me-1"></i>Create Branch
                                </a>

                                <div class="modal fade create-branch-modal" id="createBranchModal" tabindex="-1"
                                    aria-labelledby="createBranchModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.branches.store') }}" method="post"
                                                enctype="multipart/form-data">
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
                                                                placeholder="Username" id="branchName" name="name">
                                                        </div>
                                                    </div>




                                                    <div class="mb-3 image-area">
                                                        <label for="branchName" class="form-label">Branch Image</label>

                                                        <!-- Hidden input to store file data -->
                                                        <input type="file" name="image" id="hiddenFileInput"
                                                            style="display: none;">


                                                        <div class="dropzone dz-clickable" id="myDropzone">
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

                <div class="card">
                    <div class="card-body">

                        <div class="py-3">
                            <div id="table-gridjs"></div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div>
                        <div class="table-responsive table-centered">
                            <table class="table text-nowrap mb-0">
                                <thead class="bg-light bg-opacity-50">
                                    <tr>
                                        <th class="border-0 py-2">Invoice ID</th>
                                        <th class="border-0 py-2">Customer</th>
                                        <th class="border-0 py-2">Created Date</th>
                                        <th class="border-0 py-2">Due Date</th>
                                        <th class="border-0 py-2">Amount</th>
                                        <th class="border-0 py-2">Payment Status</th>
                                        <th class="border-0 py-2">Via</th>
                                        <th class="border-0 py-2">Action</th>
                                    </tr>
                                </thead> <!-- end thead-->
                                <tbody>


                                    <tr>
                                        <td>
                                            <a href="apps-invoice-details.html" class="fw-medium">#RB1158</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/users/avatar-10.jpg" alt=""
                                                    class="avatar-xs rounded-circle me-2">
                                                <div>
                                                    <h5 class="fs-14 m-0 fw-normal">Oliver Lee</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>23 April, 2024 <small>12:09 PM</small></td>
                                        <td>30 April, 2024</td>
                                        <td>$1999.00</td>
                                        <td>
                                            <span class="badge badge-soft-warning">Unpaid</span>
                                        </td>
                                        <td>Wise</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i
                                                    class="bx bx-edit fs-16"></i></button>
                                            <button type="button" class="btn btn-sm btn-soft-danger"><i
                                                    class="bx bx-trash fs-16"></i></button>
                                        </td>
                                    </tr>

                                </tbody> <!-- end tbody -->
                            </table> <!-- end table -->
                        </div> <!-- table responsive -->
                        <div
                            class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
                            <div class="col-sm">
                                <div class="text-muted">
                                    Showing <span class="fw-semibold">10</span> of <span class="fw-semibold">52</span>
                                    invoices
                                </div>
                            </div>
                            <div class="col-sm-auto mt-3 mt-sm-0">
                                <ul class="pagination pagination-rounded m-0">
                                    <li class="page-item">
                                        <a href="#" class="page-link"><i class='bx bx-left-arrow-alt'></i></a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link"><i class='bx bx-right-arrow-alt'></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div>

    <script src="{{ asset('assets/js/admin/branches.js') }}"></script>
@endsection
