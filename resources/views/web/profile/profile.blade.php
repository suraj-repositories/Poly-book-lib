@extends('layout.layout')

@section('title', Route::is('profile.index') ? 'Profile' : '')

@section('content')
    <main class="main profile">

        @include('web.profile.profile_bredcrumbs')

        <section id="service-details" class="service-details section">
            <div class="container">
                @include('layout.alert')
                <div class="row gy-5 justify-content-center">
                    <div class="col-lg-8 ps-lg-4 order-lg-1 book-data" data-aos="fade-up" data-aos-delay="200">
                        <div id="team" class="team section mt-0 pt-0 w-100">

                            <h3>Welcome {{ $user->name }}</h3>

                            @include('web.profile.user_analysis_cards')

                            <br>

                            <div class="container mt-4">
                                <div>
                                    <nav>
                                        <div class="nav nav-tabs mb-3">
                                            <button class="nav-link  active" type="button" role="tab"
                                                id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                                aria-controls="nav-about" aria-selected="true">Downloaded Books</button>
                                            <button class="nav-link " type="button" role="tab" id="nav-mission-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-mission"
                                                aria-controls="nav-mission" aria-selected="false">Feedback Reviews</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content mb-5">
                                        <div class="tab-pane active pt-2" id="nav-about" role="tabpanel"
                                            aria-labelledby="nav-about-tab">

                                           @include('web.profile.user_downloaded_books')

                                        </div>
                                        <div class="tab-pane" id="nav-mission" role="tabpanel"
                                            aria-labelledby="nav-mission-tab">

                                            @include('web.profile.user_reviews')

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <div class="position-relative p-0">
                            <div class="profile-img">
                                <img src="{{ $user->getImageURL() }}" alt="Profile" class="profile-image-preview">
                                <form action="{{ route('profile.image_update', $user) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label class="edit-image" for="edit-profile-image">
                                        <input type="file" name="image" class="d-none" id="edit-profile-image"
                                            accept="image/*">
                                        <iconify-icon icon="solar:gallery-edit-bold-duotone"></iconify-icon>
                                    </label>
                                </form>
                            </div>

                            <div class="d-flex justify-content-center">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-danger d-flex align-items-center">
                                        <iconify-icon icon="solar:logout-2-line-duotone" class="fs-4 fw-bold me-2"></iconify-icon>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </main>


    <script src="{{ asset('assets/js/pages/profile.js') }}"></script>
@endsection
