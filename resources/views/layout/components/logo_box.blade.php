<div class="logo-box">
    <a href="{{ route('home') }}" class="logo-dark">
        <img src="{{ Settings::get('logo', config('app.logo')) }}" class="logo-sm" alt="logo sm">
        <img src="{{ asset('assets/images/logo-dark.png') }}" class="logo-lg poly-book-logo" alt="logo dark">
    </a>

    <a href="{{ route('home') }}" class="logo-light">
        <img src="{{ Settings::get('logo', config('app.logo')) }}" class="logo-sm" alt="logo sm">
        <img src="{{ asset('assets/images/logo-light.png') }}" class="logo-lg poly-book-logo" alt="logo light">
    </a>
</div>
