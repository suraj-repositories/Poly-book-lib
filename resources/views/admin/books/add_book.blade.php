@extends('admin.layout.layout')
@section('title', Route::is('admin.books.create') ? 'Add Book' : '')
@section('content')

    <div class="container-fluid books">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:floor-lamp-broken" class="me-1 pt-1"></iconify-icon>
                                Add New Book


                            </div>
                            <div>
                                <a href="{{ route('admin.books') }}" class="btn btn-success">
                                    <i class='bx bx-list-ul me-1 fs-4'></i>Show Books
                                </a>


                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>


                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="branchName" class="form-label must">Select Branch</label>

                                                <div class="input-group mb-3 flex-no-wrap">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <iconify-icon icon="solar:book-broken"></iconify-icon>
                                                    </span>
                                                    <div class="w-100">
                                                        <select class="form-control one-three-no-rounded" data-choices
                                                            name="branch_id">
                                                            <option value="" disabled selected>-- select branch --
                                                            </option>
                                                            @foreach ($branches as $branch)
                                                                <option value="{{$branch->id}}">{{ $branch->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="semesterName" class="form-label must">Select Semester</label>

                                                <div class="input-group mb-3 flex-no-wrap">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <iconify-icon icon="solar:book-broken"></iconify-icon>
                                                    </span>
                                                    <div class="w-100">
                                                        <select class="form-control one-three-no-rounded" data-choices
                                                            name="semester_id">
                                                            <option value="" disabled selected> -- select semester --
                                                            </option>
                                                            @foreach ($semesters as $semester)
                                                                <option value="{{$semester->id}}">Semester {{ $loop->iteration }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="bookName" class="form-label must">Book Name</label>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <iconify-icon icon="solar:book-broken"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter book name..." id="bookhName" name="name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="authorName" class="form-label">Book Author</label>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <iconify-icon icon="solar:book-broken"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter author name..." id="bookAuthor" name="author">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="authorName" class="form-label">Description</label>
                                                <div id="snow-editor" data-editor="quill-editor" style="height: 150px;">

                                                </div>


                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="authorName" class="form-label">Number of Pages</label>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <iconify-icon icon="solar:file-text-broken"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter number of pages..." id="bookAuthor"
                                                        name="author">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="authorName" class="form-label">Price</label>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <iconify-icon icon="solar:dollar-broken"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter amount ..." id="bookAuthor" name="author">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <div class="mb-3 image-area">
                                        <label for="coverImage" class="form-label">Cover Image</label>

                                        <input type="file" name="image" id="hiddenFileInput" class="hidden">


                                        <div class="dropzone dz-clickable cover_file_input_dropzone">
                                            <div class="dz-message needsclick">
                                                <i class="h1 bx bx-cloud-upload"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                                <span class="text-muted fs-13">
                                                    (Select the cover image of book to upload.)
                                                </span>
                                            </div>
                                        </div>

                                        {{-- <ul class="list-unstyled mb-0" id="dropzone-preview" style="display: none;">
                                            <li class="mt-2" id="dropzone-preview-list">
                                                <div class="border rounded">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded">
                                                                <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                                    src="https://placehold.co/80x80" alt="Dropzone-Image" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1">
                                                                <h5 class="fs-14 mb-1" data-dz-name>&nbsp;
                                                                </h5>
                                                                <p class="fs-13 text-muted mb-0" data-dz-size></p>
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
                                        </ul> --}}
                                        <ul class="list-unstyled mb-0" id="dropzone-preview" style="display: none;">
                                            <li class="mt-2 w-100" id="dropzone-preview-list">

                                                <div class="preview-image-box">
                                                    <div class="selected_file_image">
                                                        <img data-dz-thumbnail src="https://placehold.co/80x110" class="selected_file_image" alt="selected image">
                                                        <div class="close-btn" data-dz-remove>
                                                            <iconify-icon icon="solar:trash-bin-trash-bold-duotone" class="cursor-pointer"></iconify-icon>
                                                        </div>
                                                        <div class="text-content text-light">
                                                            <div class="file_name" data-dz-name>

                                                            </div>
                                                            <div class="size text-light" data-dz-size></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>



                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body">

                                    <div class="mb-3 image-area">
                                        <label for="coverImage" class="form-label">Select Book</label>

                                        <div class="dropzone dz-clickable" data-bs-toggle="modal"
                                            data-bs-target="#selectFile">
                                            <div class="dz-message needsclick">
                                                <i class="h1 bx bx-cloud-upload"></i>
                                                <h3>Open media picker.</h3>
                                                <span class="text-muted fs-13">
                                                    (Select the of book to upload.)
                                                </span>
                                            </div>
                                        </div>

                                        <ul class="list-unstyled mb-0" id="dropzone-preview" style="display: none;">
                                            <li class="mt-2" id="dropzone-preview-list">
                                                <div class="border rounded">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded">
                                                                <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                                    src="#" alt="Dropzone-Image" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1">
                                                                <h5 class="fs-14 mb-1" data-dz-name>&nbsp;
                                                                </h5>
                                                                <p class="fs-13 text-muted mb-0" data-dz-size></p>
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
                            </div>
                        </div>
                    </div>


                    <div class="d-flex mb-3 gap-2 align-items-center justify-content-center">
                        <button class="btn btn-secondary px-4">Reset</button>
                        <button class="btn btn-primary px-4" type="submit">Save</button>
                    </div>

                </form>
            </div>

            <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->

    @include('admin.books.partials.select_file_modal')

    <script src="{{ asset('assets/js/admin/books.js') }}"></script>
@endsection
