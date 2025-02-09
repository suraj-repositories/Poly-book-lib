@extends('layout.layout')
@section('title', Route::is('home') ? 'Home' : '')

@section('content')
    <main class="main">


        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                        <h1>Read, Discover, Download, Enjoy!</h1>
                        <p>Discover books and notes — download instantly, anytime!</p>
                        <div class="d-flex">
                            <a href="{{ route('branches') }}" class="btn-get-started">Get Started</a>
                            <a href="{{ Settings::get('tutorial_video_link', config('app.tutorial_video_link')) }}"
                                class="glightbox btn-watch-video d-flex align-items-center border-2 border-dark">
                                <i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Featured Section -->
        {{-- @include('web.home.features') --}}
        <!-- /Featured Section -->

        <section id="team" class="team section">
            @include('web.branches.branch_heading')
            <x-branch-card-list max-cards="7" shuffle="true"/>
        </section>

        <!-- About Section -->
        @include('web.about.about_content')
        <!-- /About Section -->

        <!-- Stats Section -->
       <x-web.stats />
        <!-- /Stats Section -->

        <!-- Services Section -->
        {{-- @include('web.home.services') --}}
       <!-- /Services Section -->

        <!-- Portfolio Section -->
        {{-- @include('web.home.portfolio') --}}
        <!-- /Portfolio Section -->

        <!-- Testimonials Section -->
        @include('web.partials.testimonials')
        <!-- /Testimonials Section -->

        <!-- Call To Action Section -->
        {{-- @include('web.home.call_to_action') --}}
        <!-- /Call To Action Section -->

        <!-- Team Section -->
        {{-- @include('web.partials.team') --}}
        <!-- /Team Section -->

        <!-- Contact Section -->
        @include('web.contact.contact_content')
        <!-- /Contact Section -->

    </main>
@endsection
