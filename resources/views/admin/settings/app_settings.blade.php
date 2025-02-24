@extends('admin.layout.layout')
@section('title', Route::is('admin.app_settings.index') ? 'Application Settings' : '')
@section('content')

    <div class="container-fluid contact-settings">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:settings-broken" class="me-1 pt-1"></iconify-icon>
                                Application Settings
                            </div>
                            <div>


                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-body">
                                <form action="{{ route('admin.app_settings.save') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address-section" class="form-label">Address</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon1">
                                                        <iconify-icon icon="hugeicons:location-05"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('address', Settings::get('address', config('app.address')) ?? '') }}"
                                                        placeholder="company address..." id="address-section"
                                                        name="address">
                                                </div>
                                                @error('address')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-8" class="form-label"> Primary Contact</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon8">
                                                        <iconify-icon icon="solar:phone-broken"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="tel" class="form-control"
                                                        value="{{ old('primary_contact', Settings::get('primary_contact', config('app.primary_contact')) ?? '') }}"
                                                        placeholder="Enter contact phone number" id="social-8"
                                                        name="primary_contact">
                                                </div>
                                                @error('primary_contact')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-8" class="form-label">Secondary Contact</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon8">
                                                        <iconify-icon icon="solar:phone-broken"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="tel" class="form-control"
                                                        value="{{ old('secondary_contact',  Settings::get('secondary_contact', config('app.secondary_contact')) ?? '') }}"
                                                        placeholder="Enter another phone number" id="social-8"
                                                        name="secondary_contact">
                                                </div>
                                                @error('secondary_contact')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="social-8" class="form-label">Support Email</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon8">
                                                        <iconify-icon icon="weui:email-outlined"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="email" class="form-control"
                                                        value="{{ old('contact_email',  Settings::get('contact_email', config('app.contact_email')) ?? '') }}"
                                                        placeholder="Enter email address" id="social-8"
                                                        name="contact_email">
                                                </div>
                                                @error('contact_email')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="social-8" class="form-label">Location</label>

                                                <div class="input-group">
                                                    <span class="input-group-text py-0 px-2" id="basic-addon8">
                                                        <iconify-icon icon="fluent:location-28-regular"
                                                            class="fs-3"></iconify-icon>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('location',  Settings::get('location', '') ?? '') }}"
                                                        placeholder="Enter google map location share link..." id="social-8"
                                                        name="location">
                                                </div>
                                                @error('location')
                                                    <small class="validation-error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <iframe class="frame-style" data-google-map="share"
                                                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3570.8964232962894!2d80.2854483!3d26.4912796!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399c383cda76b883%3A0x570e07ac70db62ee!2sGovernment%20Polytechnic%20Kanpur!5e0!3m2!1sen!2sin!4v1740333286845!5m2!1sen!2sin"
                                                    style="border:0;" allowfullscreen="" loading="lazy"
                                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                    <div class="col-md-4 ">
                        <div class="card">

                            <div class="card-body">

                                <h4>Settings</h4>


                                <div class="form-check form-checkbox-warning py-2 my-2 dash-bottom-border dash-top-border">
                                    <input type="checkbox" class="form-check-input" id="registrationMail" checked>
                                    <label class="form-check-label" for="registrationMail">Send Email on User
                                        Registration</label>
                                </div>
                                <div class="form-check form-checkbox-warning pb-2 mb-2 dash-bottom-border">
                                    <input type="checkbox" class="form-check-input" id="mailtainence" checked>
                                    <label class="form-check-label" for="mailtainence">Site Maintenance Mode</label>
                                </div>
                                <div class="form-check form-checkbox-warning pb-2 mb-2 dash-bottom-border">
                                    <input type="checkbox" class="form-check-input" id="social_login" checked>
                                    <label class="form-check-label" for="social_login"> Enable Social Login (Google,
                                        Facebook, etc.)</label>
                                </div>
                                <div class="form-check form-checkbox-warning pb-2 mb-2 dash-bottom-border">
                                    <input type="checkbox" class="form-check-input" id="guest_downloads" checked>
                                    <label class="form-check-label" for="guest_downloads">Allow Guest Downloads</label>
                                </div>
                                <div class="form-check form-checkbox-warning pb-2 mb-2 dash-bottom-border">
                                    <input type="checkbox" class="form-check-input" id="social_media_sharing" checked>
                                    <label class="form-check-label" for="social_media_sharing"> Enable Social Media Sharing
                                        Buttons</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    <script src="{{ asset('assets/js/admin/app_settings.js') }}"></script>
@endsection
