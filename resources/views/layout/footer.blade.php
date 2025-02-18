<footer id="footer" class="footer">

    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6">
                    <h4>Subscribe {{ Settings::get('site_name', config('app.name')) }}</h4>
                    <p>Subscribe to {{ Settings::get('site_name', config('app.name')) }} and receive the latest updates
                        and services!</p>
                    <form action="{{ route('subscriber.store') }}" method="post" class="php-email-form">
                        @csrf
                        <div class="newsletter-form">
                            <input type="email" name="email">
                            <input type="submit" value="Subscribe">
                        </div>
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index-2.html" class="d-flex align-items-center">
                    <span class="sitename">{{ Settings::get('site_name', config('app.name')) }}</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>{{ Settings::get('address', config('app.address')) }}</p>

                    <p class="mt-3"><strong>Phone:</strong>
                        <span>{{ Settings::get('primary_contact', config('app.primary_contact')) }}</span>
                    </p>
                    <p><strong>Email:</strong> <span>{{ Settings::get('email', config('app.email')) }}</span></p>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('about') }}">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('contact') }}">Contact us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of Services</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Features</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('branches') }}">Branches</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('books') }}">Books</a></li>
                    @auth
                        @if (Auth::user()->hasRole('ADMIN'))
                            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                        <li><i class="bi bi-chevron-right"></i> <a
                                href="{{ route('profile.index', Auth::id()) }}">Profile</a></li>
                    @endauth

                    @guest
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('login') }}">Login</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('register') }}">Register</a></li>
                    @endguest
                </ul>
            </div>

            <div class="col-lg-4 col-md-12">
                <h4>Follow Us</h4>
                <p></p>
                <div class="d-flex flex-start">
                    <x-social-media-icons />
                </div>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">PolyBookLib</strong> <span>All Rights Reserved</span>
        </p>
        <div class="credits">

            Designed by <a href="https://github.com/ProjectsAndPrograms" target="_blank">ProjectsAndPrograms</a>
            Distributed by <a href="#">Poly-Book-Lib</a>
        </div>
    </div>

</footer>
