<div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="swiper init-swiper" data-speed="600" data-delay="5000"
        data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
        <script type="application/json" class="swiper-config">
{
  "loop": true,
  "speed": 600,
  "autoplay": {
    "delay": 5000
  },
  "slidesPerView": "auto",
  "pagination": {
    "el": ".swiper-pagination",
    "type": "bullets",
    "clickable": true
  },
  "breakpoints": {
    "320": {
      "slidesPerView": 1,
      "spaceBetween": 40
    },
    "1200": {
      "slidesPerView": 3,
      "spaceBetween": 20
    }
  }
}
</script>
        <div class="swiper-wrapper">

            @forelse ($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <p>
                            <i class=" bi bi-quote quote-icon-left"></i>
                            <span> {{ $testimonial->message }} </span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                        <img src="{{ $testimonial->user->getImageURL() }}" class="testimonial-img" alt="">
                        <h3>{{ $testimonial->user->name }}</h3>
                        <h4>{{ date('d M, Y', strtotime($testimonial->created_at)) }}</h4>
                    </div>
                </div><!-- End testimonial item -->

            @empty
            <x-no-data  icon="duo-icons:message-3" text="No Data" />
            @endforelse

        </div>
        <div class="swiper-pagination"></div>
    </div>

</div>
