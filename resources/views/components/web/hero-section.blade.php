<section id="hero" class="hero section">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                <h1> {{ $heroSection->title ?? '' }}</h1>
                <p> {{ $heroSection->caption ?? '' }} </p>
                <div class="d-flex">
                    <a href="{{ route('branches') }}" class="btn-get-started">Get Started</a>
                    <a href="{{ $heroSection->video_url ?? config('constants.default_video_url') }}"
                        class="glightbox btn-watch-video d-flex align-items-center border-2 border-dark">
                        <i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                <img src="{{ $heroSection?->getHeroImageURL() ?? config('constants.default_hero_image') }}" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section>
