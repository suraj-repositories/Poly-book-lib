@extends('layout.layout')

@section('title', Route::is('branches.show') ? 'Branch' : '')

@section('content')
    <main class="main book">

        @include('web.books.book_bredcrumbs')

        <section id="service-details" class="service-details section">
            <div class="container">
                <div class="row gy-5 justify-content-center">

                    <div class="col-lg-8 ps-lg-4 order-lg-2 book-data" data-aos="fade-up" data-aos-delay="200">
                        <div id="team" class="team section mt-0 pt-0">

                            <div class="container book section-title text-start p-0 mb-2" data-aos="fade-up">
                                <h2 class="fw-bold"> Industrial Management and intreneur Development</h2>
                                <div class="d-flex align-items-center text-warning">
                                    <iconify-icon icon="solar:star-bold"></iconify-icon>
                                    <iconify-icon icon="solar:star-bold"></iconify-icon>
                                    <iconify-icon icon="solar:star-bold"></iconify-icon>
                                    <iconify-icon icon="solar:star-bold"></iconify-icon>
                                    <iconify-icon icon="solar:star-bold"></iconify-icon>
                                    <div class="ms-1 text-secondary">(30 views)</div>
                                </div>

                            </div>
                            <div class="price">
                                {{-- <iconify-icon icon="bi:currency-rupee"></iconify-icon>
                                <span>0</span><sup class="mini">*</sup> --}}
                                Free
                            </div>

                            <div class="book-actions mb-3">
                                <a href="#" class="action-btn gold">
                                    <iconify-icon icon="solar:eye-bold-duotone"
                                        class="me-1 icon"></iconify-icon>
                                 Preview</a>
                                <button class="action-btn green">
                                    <iconify-icon icon="solar:download-square-bold-duotone"
                                        class="me-1 icon"></iconify-icon>
                                    Download</button>
                            </div>


                            <div class="my-3 p-2 border-start border-3" style="border-color: #10BC69;">
                                <p class="mb-1"><strong>Author:</strong> Tushar Srivastav</p>
                                <p class="mb-1"><strong>Pages:</strong> 999</p>
                                <p class="mb-0"><strong>File Size:</strong> 50MB</p>
                            </div>




                            {{-- <ul>
                                <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat.</span></li>
                                <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate
                                        velit.</span></li>
                                <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda
                                        mastiro dolore eu fugiat nulla pariatur.</span></li>
                            </ul> --}}


                            <div>
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link  active" type="button" role="tab" id="nav-about-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about"
                                            aria-selected="true">Description</button>
                                        <button class="nav-link " type="button" role="tab" id="nav-mission-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-mission" aria-controls="nav-mission"
                                            aria-selected="false">Reviews</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel"
                                        aria-labelledby="nav-about-tab">
                                        <p>The generated Lorem Ipsum is therefore always free from repetition injected
                                            humour, or non-characteristic words etc.
                                            Susp endisse ultricies nisi vel quam suscipit </p>
                                        <p>Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish
                                            filefish Antarctic
                                            icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric
                                            ray sweeper.</p>
                                        <div class="px-2">
                                            <div class="row g-4">
                                                <div class="col-6">
                                                    <div
                                                        class="row bg-light align-items-center text-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Weight</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">1 kg</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Country of Origin</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">Agro Farm</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="row bg-light text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Quality</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">Organic</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Сheck</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">Healthy</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="row bg-light text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Min Weight</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">250 Kg</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nav-mission" role="tabpanel"
                                        aria-labelledby="nav-mission-tab">
                                        <div class="d-flex">
                                            <img src="http://127.0.0.1:8000/a.png" class="img-fluid rounded-circle p-3"
                                                style="width: 100px; height: 100px;" alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>Jason Smith</h5>
                                                    <div class="d-flex mb-3">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p>The generated Lorem Ipsum is therefore always free from repetition
                                                    injected humour, or non-characteristic
                                                    words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <img src="http://127.0.0.1:8000/a.png" class="img-fluid rounded-circle p-3"
                                                style="width: 100px; height: 100px;" alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>Sam Peters</h5>
                                                    <div class="d-flex mb-3">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p class="text-dark">The generated Lorem Ipsum is therefore always free
                                                    from repetition injected humour, or non-characteristic
                                                    words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                            tempor sit. Aliqu diam
                                            amet diam et eos labore. 3</p>
                                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                            labore.
                                            Clita erat ipsum et lorem et sit</p>
                                    </div>
                                </div>
                            </div>


                        </div>





                        {{-- @include('web.partials.branner_never_stop_learning') --}}
                    </div>

                    <div class="col-lg-4 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                        @include('web.books.cover_page_preview')
                    </div>

                </div>
            </div>

        </section>
    </main>
@endsection
