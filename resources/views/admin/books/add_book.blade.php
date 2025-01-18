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
                                Add New Book

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <a href="#!" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#createBranchModal">
                                    <i class='bx bx-list-ul me-1 fs-4'></i>Show Books
                                </a>


                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>


                <div class="row">

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->


    <script src="{{ asset('assets/js/admin/branches.js') }}"></script>
@endsection
