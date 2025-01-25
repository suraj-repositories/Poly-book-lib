@extends('admin.layout.layout')
@section('title', Route::is('admin.files') ? 'File List' : '')
@section('content')

    <div class="container-fluid files">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:file-broken" class="me-1 pt-1"></iconify-icon>
                                Files
                            </div>
                            <div>
                                <a href="{{ route('admin.files.create') }}" class="btn btn-success">
                                    <i class="bx bx-plus me-1"></i>Add File
                                </a>


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
                                        {{-- <th scope="col">Cover</th> --}}
                                        <th scope="col">File Name</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Mime Type</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="check-selectpr">
                                                </div>
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>
                                                <div class="image-box">
                                                    <img src="{{ $file->getFileUrl() }}" alt="file image">
                                                </div>
                                            </td> --}}
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <i class="bi {{$file->icon}} bi-files-icon "></i>
                                                    {{-- <i class="file_icon" data-extension="png"></i> --}}
                                                        <h5 class="fs-14 m-0 fw-normal">{{ $file->file_name }}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                               {{$file->size}}
                                            </td>
                                            <td> {{$file->mime_type}} </td>
                                            <td> {{ date('d M, Y', strtotime($file->created_at)) }}
                                                <small>{{ date('h:i A', strtotime($file->created_at)) }}</small>
                                            </td>
                                            <td>

                                                <form action="{{ route('admin.files.destroy', $file->id) }}"
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

@endsection
