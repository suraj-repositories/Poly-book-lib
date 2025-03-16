@extends('admin.layout.layout')
@section('title', Route::is('admin.books') ? 'Book List' : '')
@section('content')

    <div class="container-fluid books">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div class="text-dark fs-3 fw-semibold d-flex align-items-center">
                                <iconify-icon icon="solar:notebook-broken"></iconify-icon>
                                &nbsp;Books
                            </div>
                            <div>
                                <a href="{{route('admin.books.create')}}" class="btn btn-success">
                                    <i class="bx bx-plus me-1"></i>Add Book
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
                                        {{-- <th scope="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault5">
                                            </div> --}}
                                        </th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Branch</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Last Updated</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($books as $book)
                                        <tr>
                                            {{-- <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="check-selectpr">
                                                </div>
                                            </td> --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $book->getCoverPageUrl() }}" alt=""
                                                        class="avatar-xs rounded-circle me-2">
                                                    <div>
                                                        <a href="{{ route('books.show', $book->id) }}"><h5 class="fs-14 m-0 fw-normal">{{ $book->title }}</h5></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('branches.show', $book->branchSemester->branch->id) }}">{{$book->branchSemester->branch->name ?? "-"}}</a>
                                            </td>
                                            <td> {{ $book->branchSemester->semester->title ?? "-" }}
                                                <br><small>{{ $book->branchSemester->semester->sub_title ?? "-"}}</small>
                                            </td>
                                            <td>{{ $book->author ?? "..." }}</td>
                                            <td> {{ date('d M, Y', strtotime($book->updated_at)) }}
                                                <small>{{ date('h:i A', strtotime($book->updated_at)) }}</small>
                                            </td>

                                            <td>
                                                <button data-btn-type="copy" data-copy-text="{{ route('download', ['type' => 'book', 'id' => $book->id]) }}" class="btn btn-sm btn-soft-secondary me-1 my-1" title="Copy download link">
                                                    <i class='bx bx-copy fs-16'></i>
                                                </button>
                                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-soft-secondary me-1 my-1" title="Edit">
                                                    <i class="bx bx-edit fs-16"></i>
                                                </a>
                                                <form action="{{ route('admin.books.destroy', $book->id) }}"
                                                    class="d-inline" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger my-1" title="Delete"><i
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

                                            {{-- @foreach ($semesters as $semester)
                                                <option value="{{ $semester->id }}">{{ $loop->iteration }}</option>
                                            @endforeach --}}
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
                                    <span class="text-muted fs-13">(This is just a demo dropzone.)</span>
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
