@extends('admin.layout.layout')
@section('title', Route::is('admin.help.index') ? 'Help' : '')
@section('content')

<div class="container-fluid help-faqs">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row g-xl-4">
                        @foreach($faqs->chunk(ceil($faqs->count()/2)) as $faqChunk)
                            <div class="col-xl-6">
                                @foreach($faqChunk as $category => $categoryFaqs)
                                    <h4 class="mb-3 fw-semibold fs-16">{{ ucfirst($category) }}</h4>
                                    <div class="accordion mb-4">
                                        @foreach($categoryFaqs as $index => $faq)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button fw-medium {{ $index > 0 ? 'collapsed' : '' }}" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}"
                                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                        aria-controls="faq{{ $faq->id }}">
                                                        {{ $faq->question }}
                                                    </button>
                                                </h2>
                                                <div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}">
                                                    <div class="accordion-body">
                                                        {{ $faq->answer }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row my-5">
                    <div class="col-12 text-center">
                        <h4>Can't find a questions?</h4>
                        <a href="mailto:{{ config('app.owner_email') }}" class="btn btn-light mt-2"><i class="bx bx-envelope me-1"></i>
                            Email us your question</a>
                        <a href="{{ config('app.owner_help_link') }}" target="_blank" class="btn btn-dark mt-2 ms-1"><i class="bx bxl-github me-1"></i>
                            Send us an issue</a>
                    </div>
                </div>

            </div>
        </div>
    </div>




</div>


@endsection
