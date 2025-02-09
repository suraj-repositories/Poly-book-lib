@extends('layout.layout')
@section('title', Route::is('branches.semesters.books') ? 'Semester' : '')

@section('content')
    <main class="main semesters">

        @include('web.semesters.semester_bredcrumbs')

        <section id="service-details" class="service-details section">
            <div class="container">
                <div class="row gy-5">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

                        @include('web.semesters.branch_semester_card')

                        <div class="my-3">

                            @include('web.semesters.semester_card')
                        </div>

                        <x-download-catalog :branch=$branch  :semester=$semester />

                        @include('web.partials.help_contact')

                    </div>

                    <div class="col-lg-8 ps-lg-4" data-aos="fade-up" data-aos-delay="200">


                            <div id="team" class="team section mt-0 pt-0">
                                @include('web.semesters.current_semester_heading')

                                <div class="container">
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3  gy-4">
                                        @include('web.books.book_cards')
                                    </div>
                                </div>
                            </div>

                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
