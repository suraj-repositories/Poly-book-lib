@extends('admin.layout.layout')
@section('title', Route::is('admin.hero_section.index') ? 'Hero Section Setting' : '')
@section('content')

    <div class="container-fluid hero-section">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:settings-broken" class="me-1 pt-1"></iconify-icon>
                                Hero Section Settings
                            </div>
                            <div>
                                <a href="{{ route('home') }}" target="_blank"
                                    class="btn btn-outline-success d-flex align-items-center justify-content-center">

                                    <iconify-icon icon="hugeicons:link-forward" class=" fs-4 me-1"></iconify-icon>
                                    <span>Show Preview</span>
                                </a>

                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>

                <form action="{{ route('admin.hero_section.save') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card">

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="hero_title" class="form-label">Title</label>

                                            <div class="input-group">
                                                <span class="input-group-text py-0 px-2" id="basic-addon1">
                                                    <iconify-icon icon="solar:notes-line-duotone"
                                                        class="fs-3"></iconify-icon>
                                                </span>
                                                <input type="text" class="form-control"
                                                    value="{{ old('title', $heroSection['title'] ?? '') }}"
                                                    placeholder="hero section title..." id="hero_title" name="title">
                                            </div>
                                            @error('title')
                                                <small class="validation-error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="hero-caption" class="form-label">Caption</label>

                                            <div class="input-group">
                                                <span class="input-group-text py-0 px-2" id="basic-addon1">
                                                    <iconify-icon icon="solar:notes-line-duotone"
                                                        class="fs-3"></iconify-icon>
                                                </span>
                                                <input type="text" class="form-control"
                                                    value="{{ old('caption', $heroSection['caption'] ?? '') }}"
                                                    placeholder="short caption here..." id="hero-caption" name="caption">
                                            </div>
                                            @error('caption')
                                                <small class="validation-error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="social-1" class="form-label">Video Link</label>

                                            <div class="input-group">
                                                <span class="input-group-text py-0 px-2" id="basic-addon1">
                                                    <iconify-icon icon="uit:youtube" class="fs-3"></iconify-icon>
                                                </span>
                                                <input type="text" class="form-control"
                                                    value="{{ old('video_url', $heroSection['video_url'] ?? '') }}"
                                                    placeholder="youtube video link..." id="social-1" name="video_url">
                                            </div>
                                            @error('video_url')
                                                <small class="validation-error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <iframe class="frame-style" data-youtube-video="share"
                                                src="{{ $heroSection['video_url'] ?? config('constants.default_video_url') }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">

                                        <div class="row">


                                            <div class="col-12">

                                                <div class="mb-3 image-area">
                                                    <label for="heroImage" class="form-label">Hero Image</label>

                                                    <input type="file" name="hero_image" id="hiddenFileInput" class="hidden"
                                                        data-hero-image="{{ isset($heroSection, $heroSection->hero_image) ? $heroSection->getHeroImageURL() : '' }}"
                                                        data-hero-image-size="{{ isset($heroSection) ? $heroSection->getHeroImageSize() : '0MB' }}">


                                                    <div class="dropzone dz-clickable hero_image_input_dropzone">
                                                        <div class="dz-message needsclick">
                                                            <i class="h1 bx bx-cloud-upload"></i>
                                                            <h3>Drop files here or click to upload.</h3>
                                                            <span class="text-muted fs-13">
                                                                (Select the hero image for website to upload.)
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <ul class="list-unstyled mb-0" id="dropzone-preview"
                                                        style="display: none;">
                                                        <li class="mt-2 w-100" id="dropzone-preview-list">

                                                            <div class="preview-image-box">
                                                                <div class="selected_file_image">
                                                                    <img data-dz-thumbnail
                                                                        src="https://placehold.co/100x100?text=loading..."
                                                                        class="selected_file_image" alt="selected image">
                                                                    <div class="close-btn" data-dz-remove>
                                                                        <iconify-icon
                                                                            icon="solar:trash-bin-trash-bold-duotone"
                                                                            class="cursor-pointer"></iconify-icon>
                                                                    </div>
                                                                    <div class="text-content text-light">
                                                                        <div class="file_name" data-dz-name>

                                                                        </div>
                                                                        <div class="size text-light" data-dz-size>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </li>
                                                    </ul>

                                                    @error('hero_image')
                                                        <small class="validation-error">{{ $message }}</small>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">

                                        <div class="card-body">

                                            <div class="row">


                                                <div class="col-12">

                                                    <div class="mb-3 image-area">
                                                        <label for="aboutImage" class="form-label">About Image</label>

                                                        <input type="file" name="about_image" id="hiddenFileInput"
                                                            class="hidden"
                                                            data-about-image="{{ isset($heroSection, $heroSection->about_image) ? $heroSection->getAboutImageUrl() : '' }}"
                                                            data-about-image-size="{{ isset($heroSection) ? $heroSection->getAboutImageSize() : '0MB' }}">


                                                        <div class="dropzone dz-clickable about_image_input_dropzone">
                                                            <div class="dz-message needsclick">
                                                                <i class="h1 bx bx-cloud-upload"></i>
                                                                <h3>Drop files here or click to upload.</h3>
                                                                <span class="text-muted fs-13">
                                                                    (Select the about image for website to upload.)
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <ul class="list-unstyled mb-0" id="dropzone-preview"
                                                            style="display: none;">
                                                            <li class="mt-2 w-100" id="dropzone-preview-list">

                                                                <div class="preview-image-box">
                                                                    <div class="selected_file_image">
                                                                        <img data-dz-thumbnail
                                                                            src="https://placehold.co/100x100?text=loading..."
                                                                            class="selected_file_image"
                                                                            alt="selected image">
                                                                        <div class="close-btn" data-dz-remove>
                                                                            <iconify-icon
                                                                                icon="solar:trash-bin-trash-bold-duotone"
                                                                                class="cursor-pointer"></iconify-icon>
                                                                        </div>
                                                                        <div class="text-content text-light">
                                                                            <div class="file_name" data-dz-name>

                                                                            </div>
                                                                            <div class="size text-light" data-dz-size>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </li>
                                                        </ul>

                                                        @error('about_image')
                                                            <small class="validation-error">{{ $message }}</small>
                                                        @enderror

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                    <!-- end card -->
                </div>

               <!-- end row -->

               <div class="d-flex mb-3 gap-2 align-items-center justify-content-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4">Cancel</a>
                <button class="btn btn-primary px-4" type="submit">Save</button>
            </div>
                </form>

            </div>
        </div>

        <script src="{{ asset('assets/js/admin/hero_section.js') }}"></script>
 @endsection
