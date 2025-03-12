@extends('layout.layout')

@section('title', Route::is('books.show') ? 'Book Download' : '')

@section('content')
    <main class="main book">

        @include('web.books.book_bredcrumbs')

        <section id="service-details" class="service-details section">
            <div class="container">

                @include('layout.alert')

                <div class="row gy-5 justify-content-center">

                    <div class="col-lg-8 ps-lg-4 order-lg-2 book-data" data-aos="fade-up" data-aos-delay="200">
                        <div id="team" class="team section mt-0 pt-0">

                            <div class="container book section-title text-start p-0 mb-2" data-aos="fade-up">
                                <h2 class="fw-bold"> {{ $book->title }}</h2>
                                <div class="d-flex align-items-center">

                                    @for ($i = 1; $i <= 5; $i++)
                                        <iconify-icon icon="solar:star-bold"
                                            class=" {{ $i <= $bookRating ? 'text-warning' : '' }}"></iconify-icon>
                                    @endfor

                                    @if ($bookReviewCount > 0)
                                        <div class="ms-1 text-secondary"> ({{ $bookReviewCount }} reviews)</div>
                                    @endif

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
                                @if (optional($book->file)->getFileUrl())
                                    <a href="{{ $book->file->getFileUrl() }}" target="_blank" class="action-btn secondary">
                                        <iconify-icon icon="solar:eye-bold-duotone" class="me-1 icon"></iconify-icon>
                                        Preview
                                    </a>
                                    <form action="{{ route('download', ['type' => 'book', 'id' => $book->id]) }}" method="GET">
                                        @csrf
                                        <button class="action-btn green">
                                            <iconify-icon icon="solar:download-square-bold-duotone"
                                                class="me-1 icon"></iconify-icon>
                                            Download</button>
                                    </form>

                                    @if (Settings::get('social_media_sharing', config('app.social_media_sharing')) != 'off')
                                        <button class="action-btn gold" data-bs-toggle="modal" data-bs-target="#shareModal">
                                            <iconify-icon icon="solar:share-line-duotone" class="me-1 icon"></iconify-icon>
                                            Share</button>
                                    @endif
                                @else
                                    <button class="action-btn not-available bg-light text-warning" disabled>
                                        <iconify-icon icon="twemoji:warning" class="me-2 icon"></iconify-icon>
                                        Book Not Available
                                    </button>
                                @endif


                                @if (Settings::get('social_media_sharing', config('app.social_media_sharing')) != 'off')
                                    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered rounded-0">
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark">
                                                    <h1 class="modal-title fs-5 text-light" id="shareModalLabel">Share Book
                                                    </h1>
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
                                                                    <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}"
                                                                        target="_blank">
                                                                        <i class="bi bi-telegram"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a
                                                                        href="mailto:?subject=Check this out&body={{ urlencode(url()->current()) }}">
                                                                        <i class="bi bi-envelope"></i>
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
                                @endif
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
                                            data-bs-toggle="tab" data-bs-target="#nav-mission"
                                            aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel"
                                        aria-labelledby="nav-about-tab">

                                        {!! $book->description !!}

                                    </div>
                                    <div class="tab-pane" id="nav-mission" role="tabpanel"
                                        aria-labelledby="nav-mission-tab">

                                        @include('web.books.review_form')

                                        @include('web.books.book_reviews')

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                        @include('web.books.cover_page_preview')
                    </div>

                </div>
            </div>

        </section>
    </main>
    <script src="{{ asset('assets/js/pages/book.js') }}"></script>
@endsection
