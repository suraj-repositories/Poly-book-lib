@extends('layout.layout')
@section('title', Route::is('home') ? 'Home' : '')

@section('content')
    <main class="main">


        <!-- Hero Section -->
        <x-web.hero-section/>
        <!-- /Hero Section -->

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
