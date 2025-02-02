<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{route('home')}}" class="logo d-flex align-items-center me-auto">

            <h1 class="sitename d-inline">
                <img src="{{ Settings::get('logo', config('app.logo')) }}" height="30" class="me-1"
                alt="logo sm">
                <span class="appname">{{ Settings::get('site_name', config('app.name'))  }}</span></h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Home</a></li>
                <li><a href="#services">Books</a></li>
                <li class="dropdown"><a href="#"><span>Department</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span clas>Semesters</span> <i
                            class="bi bi-chevron-down ms-1 toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li>
                <li><a href="#about">About</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @guest
        <a class="btn-getstarted me-1 bg-secondary hide-sm-600" href="{{ route('register') }}">SignUp</a>
        <a class="btn-getstarted ms-1" href="{{ route('login') }}">SingIn</a>
        @endguest

        @auth

            @if (Auth::user()->hasRole('ADMIN'))
                <a class="btn-getstarted" href="{{ route('admin.dashboard') }}">Dashboard</a>
            @elseif (Auth::user()->hasRole('USER'))
            @endif

        @endauth

    </div>
</header>
