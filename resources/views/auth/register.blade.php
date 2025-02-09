@extends('auth.layout.layout')

@section('content')
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="card auth-card">
                        <div class="card-body px-3 py-5">
                            <div class="mx-auto mb-4 text-center auth-logo">
                                <a href="{{route('home')}}" class="logo-dark">
                                    <img src="{{ Settings::get('logo', config('app.logo')) }}" height="30" class="me-1"
                                        alt="logo sm">
                                    <img src="{{ asset('assets/images/logo-dark.png') }}" height="24" alt="logo dark">
                                </a>

                                <a href="{{route('home')}}" class="logo-light">
                                    <img src="{{ Settings::get('logo', config('app.logo')) }}" height="30" class="me-1"
                                        alt="logo sm">
                                    <img src="{{ asset('assets/images/logo-light.png') }}" height="24" alt="logo light">
                                </a>
                            </div>

                            <h2 class="fw-bold text-center fs-18">Register</h2>
                            <p class="text-muted text-center mt-1 mb-4">New to our platform? Sign up now! It only takes a
                                minute.</p>

                            <div class="px-4">

                                @include('layout.alert')

                                <form action="{{ route('register.save') }}" method="POST" class="authentication-form">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="name" id="name" name="name" class="form-control"
                                            placeholder="Enter your name">

                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="Enter your email">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="text" id="password" name="password" class="form-control"
                                            placeholder="Enter your password">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="terms"
                                                id="checkbox-signin">
                                            <label class="form-check-label" for="checkbox-signin">I accept Terms and
                                                Condition</label>
                                        </div>
                                        @error('terms')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-1 text-center d-grid">
                                        <button class="btn btn-primary" type="submit">Sign Up</button>
                                    </div>
                                </form>

                                {{-- @include('auth.layout.social_media') --}}

                            </div> <!-- end col -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->

                    <p class="mb-0 text-center">I already have an account <a href="{{route('login')}}"
                            class="text-reset fw-bold ms-1">Sign In</a></p>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
