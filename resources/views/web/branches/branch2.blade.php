@extends('layout.layout')

@section('title', Route::is('branches.show') ? 'Branch' : '')

@section('content')
<main class="main semesters">

    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Branches</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('branches') }}">Branches</a></li>
                    <li class="current">Plastic Mould Technology</li> {{--  Make this dynamic if possible --}}
                </ol>
            </nav>
        </div>
    </div>

    <section id="service-details" class="service-details section">
        <div class="container">
            <div class="row gy-5">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-box position-relative p-0">
                        <div class="branch-img">
                            <img src="{{ asset('storage/branches/cBYVUqpzF1B624uj8wGMWAG1oMyxZ9DrYor0qzQL.jpg') }}" alt="Branch"> {{-- Use asset() helper --}}
                        </div>

                        <div class="p-3">
                            <h4>Plastic Mould Technology</h4> {{-- Make this dynamic if possible --}}

                            <div class="services-list left-border-links">
                                <a href="#" class="active">
                                    <iconify-icon icon="solar:clipboard-broken"></iconify-icon>
                                    <span class="ms-1">Semesters</span>
                                </a>
                                <a href="#">
                                    <iconify-icon icon="solar:notebook-broken"></iconify-icon>
                                    <span class="ms-1">Books</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="service-box">
                        <h4>Download Catalog</h4>
                        <div class="download-catalog">
                            <a href="#" class="d-flex">
                                <i class="bi bi-box-arrow-down"></i>
                                <span>Downloads</span>
                                <span class="ms-auto fw-bold">52590 +</span> {{-- Make this dynamic if possible --}}
                            </a>
                            <a href="#">
                                <i class="bi bi-filetype-pdf"></i>
                                <span>Books</span>
                                <span class="ms-auto fw-bold">9 + </span> {{-- Make this dynamic if possible --}}
                            </a>
                        </div>
                    </div>

                    @include('web.partials.help_contact')

                </div>

                <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="row row-cols-1 row-cols-lg-2 g-4">

                        @forelse ([1, 2, 3, 5, 6, 7] as $item) {{-- Replace this with your actual loop using data from database --}}
                            <div class="col">
                                <div class="service-box semester-card card-shadow rounded-0">
                                    <div class="card-body">
                                        <div class="image-with-title">
                                            <div class="img-alt">
                                                <iconify-icon icon="vscode-icons:folder-type-log-opened"></iconify-icon>
                                            </div>
                                            <a href=""> {{-- Add the correct link here --}}
                                                <div class="title-area">
                                                    <div class="title">Semester {{ $item }}</div> {{-- Make this dynamic --}}
                                                    <div class="sub-title">6 months</div> {{-- Make this dynamic if possible --}}
                                                </div>
                                            </a>
                                        </div>

                                        <div class="actions">
                                            <iconify-icon icon="solar:notebook-broken"></iconify-icon>
                                            <span class="fw-bold mx-1">12</span> {{-- Make this dynamic if possible --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            @include('layout.no_data')
                        @endforelse

                    </div>

                    <div class="row justify-content-center flex-column mt-4">
                        <img src="{{ asset('assets/img/branners/solo-learning.png') }}" alt="Banner" class="dim-3"> {{-- Use asset() helper --}}
                        <h4 class="text-center fw-bold dim-3">Never Stop Learning</h4>
                    </div>

                </div>

            </div>
        </div>
    </section>
</main>
@endsection
