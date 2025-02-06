@extends('layout.layout')

@section('title', Route::is('books.show') ? 'Book Download' : '')

@section('content')
    <main class="main book">

        @include('web.books.book_bredcrumbs')

        <section id="service-details" class="service-details section">
            <div class="container">
                <div class="row gy-5 justify-content-center">

                    <div class="col-lg-8 ps-lg-4 order-lg-2 book-data" data-aos="fade-up" data-aos-delay="200">
                        <div id="team" class="team section mt-0 pt-0">

                            <div class="container book section-title text-start p-0 mb-2" data-aos="fade-up">
                                <h2 class="fw-bold"> {{ $book->title }}</h2>
                                <div class="d-flex align-items-center text-warning">
                                    <iconify-icon icon="solar:star-bold"></iconify-icon>
                                    <div class="ms-1 text-secondary">(30 views)</div>
                                </div>

                            </div>
                            <div class="price mb-3">
                                @if ($book->price && $book->price > 0)
                                    <iconify-icon icon="bi:currency-rupee" class="me-0"></iconify-icon>
                                    <span>{{ $book->price }}</span>
                                @else
                                    Free
                                @endif
                            </div>

                            <div class="book-actions mb-3 flex-wrap">
                                <a href="{{ $book->file?->getFileUrl() }}" target="_blank" class="action-btn secondary">
                                    <iconify-icon icon="solar:eye-bold-duotone" class="me-1 icon"></iconify-icon>
                                    Preview</a>
                                <button class="action-btn green">
                                    <iconify-icon icon="solar:download-square-bold-duotone"
                                        class="me-1 icon"></iconify-icon>
                                    Download</button>
                                <button class="action-btn gold" data-bs-toggle="modal" data-bs-target="#shareModal">
                                    <iconify-icon icon="solar:share-line-duotone" class="me-1 icon"></iconify-icon>
                                    Share</button>

                                <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered rounded-0">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark" style="background : #12BC6A">
                                                <h1 class="modal-title fs-5 text-light" id="shareModalLabel">Share Book</h1>
                                                <button type="button" class="btn-close text-light btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">



                                                <div class="shareArticle">
                                                    <div class="shareSocial">
                                                        <ul class="socialList">

                                                            <li>
                                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                                                    target="_blank">
                                                                    <i class="bi bi-facebook"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="mailto:?subject=Check this out&body={{ urlencode(url()->current()) }}">
                                                                    <i class="bi bi-envelope"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}"
                                                                    target="_blank">
                                                                    <i class="bi bi-telegram"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                                                                    target="_blank">
                                                                    <i class="bi bi-twitter-x"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="https://wa.me/?text={{ urlencode(url()->current()) }}"
                                                                    target="_blank">
                                                                    <i class="bi bi-whatsapp"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="shareLink">
                                                        <div class="permalink">
                                                            <input class="textLink" id="text" type="text"
                                                                name="shortlink" value="{{ url()->current() }}"
                                                                id="copy-link" readonly="">
                                                            <span class="copyLink" id="copy"
                                                                tooltip="Copy to clipboard">
                                                                <i class="bi bi-copy"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>


                            {{-- <div class="my-3 p-2 ps-3 border-start border-3">
                                @if (!empty($book->author))
                                    <p class="mb-1"><strong>Author : </strong> {{ $book->author }}</p>
                                @endif
                                @if (!empty($book->pages))
                                    <p class="mb-1"><strong>Pages : </strong> {{ $book->pages }}</p>
                                @endif
                                @if (!empty($book->file))
                                    <p class="mb-0"><strong>File Size : </strong> {{ $book->file?->size() }}</p>
                                @endif
                            </div> --}}

                            <div class="my-3 p-2 ps-0 d-flex gap-2 flex-wrap">
                                @if (!empty($book->author))
                                    <p class="mb-0 author-badge"><strong>Author : </strong> {{ $book->author }}</p>
                                @endif
                                @if (!empty($book->pages))
                                    <p class="mb-0 pages-badge"><strong>Pages : </strong> {{ $book->pages }}</p>
                                @endif
                                @if (!empty($book->file))
                                    <p class="mb-0 filesize-badge"><strong>File Size : </strong> {{ $book->file?->size() }}
                                    </p>
                                @endif
                            </div>


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

                                        {!! $book->description !!}

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

    <script>
        const input = document.getElementById("text");
        const copyButton = document.getElementById("copy");

        const copyText = (e) => {
            // window.getSelection().selectAllChildren(textElement);
            input.select(); //select input value
            document.execCommand("copy");
            e.currentTarget.setAttribute("tooltip", "Copied!");
        };

        const resetTooltip = (e) => {
            e.currentTarget.setAttribute("tooltip", "Copy to clipboard");
        };

        copyButton.addEventListener("click", (e) => copyText(e));
        copyButton.addEventListener("mouseover", (e) => resetTooltip(e));
    </script>
@endsection
