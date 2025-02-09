@extends('layout.layout')

@section('title', Route::is('profile.index') ? 'Profile' : '')

@section('content')
    <main class="main profile">

        @include('web.profile.profile_bredcrumbs')

        <section id="service-details" class="service-details section">
            <div class="container">
                <div class="row gy-5 justify-content-center">

                    <div class="col-lg-8 ps-lg-4 order-lg-1 book-data" data-aos="fade-up" data-aos-delay="200">
                        <div id="team" class="team section mt-0 pt-0 w-100">

                            <h3>Welcome Shubham</h3>

                            <div class="container">
                                <div class="row row-cols-md-2 row-cols-lg-3 g-3 mt-3">
                                    <div class="col">
                                        <div class="card card-shadow border-0 p-3">
                                            <div class="d-flex mb-2 align-items-center">
                                                <iconify-icon icon="solar:download-minimalistic-broken"
                                                    class="fs-3 fw-bold text-success me-2"></iconify-icon>
                                                <h3>10</h3>
                                            </div>
                                            <h5> Downloads</h5>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card card-shadow border-0 p-3">
                                            <div class="d-flex mb-2 align-items-center">
                                                <iconify-icon icon="solar:floor-lamp-line-duotone"
                                                    class="fs-3 fw-bold text-dark me-2"></iconify-icon>
                                                <h3>2</h3>
                                            </div>
                                            <h5> Explored Branches</h5>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card card-shadow border-0 p-3">
                                            <div class="d-flex mb-2 align-items-center">
                                                <iconify-icon icon="solar:star-bold-duotone"
                                                    class="fs-3 fw-bold text-warning me-2"></iconify-icon>
                                                <h3>50</h3>
                                            </div>
                                            <h5> Your Feedbacks</h5>
                                        </div>
                                    </div>


                                </div>
                            </div>

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

                                            <div class="d-flex comment mb-3">
                                                <div class="comment-user-image">
                                                    <img src="https://placehold.co/400x600" class="comment-user rounded-3"
                                                        alt="">
                                                </div>
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="heading">
                                                            <h5 class="mb-1">Jason Smith</h5>
                                                            <p class="mb-2 date">April 12, 2024</p>
                                                        </div>
                                                        <div class="d-flex mb-3">
                                                            <iconify-icon icon="solar:download-minimalistic-broken"
                                                    class="fs-3 fw-bold text-success me-2"></iconify-icon>
                                                        </div>
                                                    </div>

                                                    <p>The generated Lorem Ipsum is therefore always free from repetition
                                                        injected humour, or non-characteristic
                                                        words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="nav-mission" role="tabpanel"
                                            aria-labelledby="nav-mission-tab">
                                            <div class="d-flex comment mb-3">
                                                <div class="comment-user-image">
                                                    <img src="https://placehold.co/400x600" class="comment-user"
                                                        alt="">
                                                </div>
                                                <div class="">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="heading">
                                                            <h5 class="mb-1">Jason Smith</h5>
                                                            <p class="mb-2 date">April 12, 2024</p>
                                                        </div>
                                                        <div class="d-flex mb-3">
                                                            <iconify-icon icon="solar:star-bold"></iconify-icon>
                                                            <iconify-icon icon="solar:star-bold"></iconify-icon>
                                                            <iconify-icon icon="solar:star-bold"></iconify-icon>
                                                            <iconify-icon icon="solar:star-bold"></iconify-icon>
                                                        </div>
                                                    </div>

                                                    <p>The generated Lorem Ipsum is therefore always free from repetition
                                                        injected humour, or non-characteristic
                                                        words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="nav-vision" role="tabpanel">
                                            <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                                tempor sit. Aliqu diam
                                                amet diam et eos labore. 3</p>
                                            <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et
                                                eos
                                                labore.
                                                Clita erat ipsum et lorem et sit</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <div class="position-relative p-0">
                            <div class="profile-img">
                                <img  src="{{ $user->getImageURL() }}" alt="Profile">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label class="edit-image" for="edit-profile-image">
                                        <input type="file" name="image" class="d-none" id="edit-profile-image" accept="image/*">
                                        <iconify-icon icon="solar:gallery-edit-bold-duotone"></iconify-icon>
                                    </label>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </main>


@endsection
