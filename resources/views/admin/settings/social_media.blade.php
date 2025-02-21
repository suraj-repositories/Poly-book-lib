@extends('admin.layout.layout')
@section('title', Route::is('admin.social_media.index') ? 'Social Media Settings' : '')
@section('content')

    <div class="container-fluid social-media">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:settings-broken" class="me-1 pt-1"></iconify-icon>
                                Social Media Settings
                            </div>
                            <div>

                               <x-social-media-icons />

                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <form action="{{ route('admin.social_media.save') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-1" class="form-label">Facebook</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon1">
                                                        <iconify-icon icon="ic:sharp-facebook"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('facebook', $socialMedia['facebook'] ?? '') }}"
                                                        placeholder="www.facebook.com" id="social-1" name="facebook">
                                                </div>
                                                @error('facebook')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-2" class="form-label">Instagram</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon2">
                                                        <iconify-icon icon="ant-design:instagram-filled"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('instagram', $socialMedia['instagram'] ?? '') }}"
                                                        placeholder="www.instagram.com" id="social-2" name="instagram">
                                                </div>
                                                @error('instagram')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-3" class="form-label">Youtube</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon3">
                                                        <iconify-icon icon="nrk:some-youtube" class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="www.youtube.com"
                                                        value="{{ old('youtube', $socialMedia['youtube'] ?? '') }}"
                                                        id="social-3" name="youtube">
                                                </div>
                                                @error('youtube')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-4" class="form-label">Linkedin</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon4">
                                                        <iconify-icon icon="ant-design:linkedin-filled"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('linkedin', $socialMedia['linkedin'] ?? '') }}"
                                                        placeholder="www.linkedin.com" id="social-4" name="linkedin">
                                                </div>
                                                @error('linkedin')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-5" class="form-label">Twitter</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon5">
                                                        <iconify-icon icon="ri:twitter-x-line"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="www.twitter.com"
                                                        value="{{ old('twitter', $socialMedia['twitter'] ?? '') }}"
                                                        id="social-5" name="twitter">
                                                </div>
                                                @error('twitter')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-6" class="form-label">Github</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon6">
                                                        <iconify-icon icon="ri:github-fill" class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('github', $socialMedia['github'] ?? '') }}"
                                                        placeholder="www.github.com" id="social-6" name="github">
                                                </div>
                                                @error('github')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-7" class="form-label">Telegram</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon7">
                                                        <iconify-icon icon="ic:twotone-telegram"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('telegram', $socialMedia['telegram'] ?? '') }}"
                                                        placeholder="www.telegram.com" id="social-7" name="telegram">
                                                </div>
                                                @error('telegram')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-8" class="form-label">Reddit</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon8">
                                                        <iconify-icon icon="ic:sharp-reddit"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('reddit', $socialMedia['reddit'] ?? '') }}"
                                                        placeholder="www.reddit.com" id="social-8" name="reddit">
                                                </div>
                                                @error('reddit')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-2">
                                        <button type="submit" class="btn btn-success me-2">
                                            Submit
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

@endsection
