<div class="social-links d-flex flex-wrap justify-content-center">
    @foreach ($socialMedias as $sm)
        @if (!empty($sm->url))
            <a href="{{ $sm->url }}"><i class="{{ $sm->icon }}"></i></a>
        @endif
    @endforeach

</div>
