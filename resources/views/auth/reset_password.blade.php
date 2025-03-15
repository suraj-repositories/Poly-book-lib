@extends('auth.layout.layout')
@section('title', Route::is('password.reset') ? 'Reset Password' : '')

@section('content')
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="card auth-card">
                        <div class="card-body px-3 py-5">

                            <div class="mx-auto mb-4 text-center auth-logo">
                                <a href="{{ route('home') }}" class="logo-dark">
                                    <img src="{{ Settings::get('logo', config('app.logo')) }}" height="30" class="me-1"
                                        alt="logo sm">
                                    <img src="{{ asset('assets/images/logo-dark.png') }}" height="24" alt="logo dark">
                                </a>

                                <a href="{{ route('home') }}" class="logo-light">
                                    <img src="{{ Settings::get('logo', config('app.logo')) }}" height="30" class="me-1"
                                        alt="logo sm">
                                    <img src="{{ asset('assets/images/logo-light.png') }}" height="24" alt="logo light">
                                </a>
                            </div>

                            <h2 class="fw-bold text-center fs-18">Reset Password</h2>
                            <p class="text-muted text-center mt-1 mb-4">Reset your password here and regain access to your account!</p>



                            <div class="px-4">

                                @include('layout.alert')

                                <form action="{{ route('password.update') }}" method="POST" class="authentication-form">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="{{ $email ?? old('email') }}" placeholder="Enter your email">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="New Password">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password Confirmation</label>
                                        <input type="password" id="password" class="form-control"
                                            name="password_confirmation" placeholder="Confirm Password">

                                    </div>
                                    <div class="mb-1 text-center d-grid">
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <button class="btn btn-primary mt-2" type="submit">Reset Password</button>
                                    </div>
                                </form>


                            </div> <!-- end col -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->

                    <p class="mb-0 text-center">Go Back to - <a href="{{ route('login') }}"
                            class="text-reset fw-bold ms-1">Sign
                            In</a></p>

                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
