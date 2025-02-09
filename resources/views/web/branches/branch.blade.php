@extends('layout.layout')

@section('title', Route::is('branches.show') ? 'Branch' : '')

@section('content')
    <main class="main semesters">

        @include('web.branches.branch_bredcrumbs')

        <section id="service-details" class="service-details section">
            <div class="container">
                <div class="row gy-5">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

                        @include('web.branches.branch_show_card')

                        <x-download-catalog :branch=$branch/>

                        @include('web.partials.help_contact')

                    </div>

                    <div class="col-lg-8 ps-lg-4" data-aos="fade-up" data-aos-delay="200">

                        @if (Route::is('branches.books'))
                            <div id="team" class="team section mt-0 pt-0">
                                @include('web.books.book_heading')

                                <div class="container">
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3  gy-4">
                                        @include('web.books.book_cards')
                                    </div>
                                </div>
                            </div>
                        @else
                            @include('web.semesters.semester_cards')

                            @include('web.partials.branner_never_stop_learning')
                        @endif
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
