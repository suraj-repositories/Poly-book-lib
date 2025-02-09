<section id="about" class="about section">
    @include('web.about.about_heading')

    <div class="container">


        <div class="row gy-4">
            <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/img/about.png') }}" class="img-fluid" alt="about">
                <a href="{{ Settings::get('tutorial_video_link', config('app.tutorial_video_link')) }}" class="glightbox pulsating-play-btn"></a>
            </div>
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                <h3> {{ Settings::get('site_name', config('app.name')) }}  – Your go-to platform for easy book downloads.</h3>
                <p class="fst-italic mt-4">
                    Welcome to {{ Settings::get('site_name', config('app.name')) }} , your ultimate destination for book downloads. Our platform offers a vast collection of books across various genres, including educational, fiction, non-fiction, and research materials.
                </p>
                <ul>
                    <li><i class="bi bi-check2-all"></i> <span>We aim to make knowledge and literature easily accessible to everyone.</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>Designed for simplicity, our website ensures a smooth browsing and downloading process.</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>Our platform provides a seamless experience for downloading books quickly and conveniently.</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>Join us today and discover a world of books at your fingertips!</span></li>
                </ul>
                <p>
                    We focus on providing a seamless and user-friendly experience, making it easy for readers to browse and download books effortlessly. Our mission is to promote accessibility to knowledge and literature for everyone, ensuring that books are just a click away.
                </p>
            </div>
        </div>

    </div>

</section>
