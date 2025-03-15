<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">

            <h1 class="sitename d-inline">
                <img src="{{ Settings::get('logo', config('app.logo')) }}" height="30" class="me-1" alt="logo sm">
                <span class="appname">{{ Settings::get('site_name', config('app.name')) }}</span>
            </h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('books') }}" class="{{ Route::is('books') ? 'active' : '' }}">Books</a></li>
                <li class="dropdown"><a href="#"
                        class="{{ Route::is('branches.semesters.books') || Route::is('branches.show') ? 'active' : '' }}"><span>Branches&nbsp;</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>

                        @forelse ($branches as $branch)
                            <li class="dropdown"><a
                                    href="{{ route('branches.show', $branch->id) }}"><span>{{ $branch->name }}</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    @forelse ($branch->semesters as $semester)
                                        <li><a
                                                href="{{ route('branches.semesters.books', ['branch' => $branch->id, 'semester' => $semester->id]) }}">{{ $semester->title }}</a>
                                        </li>
                                    @empty
                                        <li><a href="#">No Semesters yet...</a></li>
                                    @endforelse

                                </ul>
                            </li>

                        @empty
                            <li><a href="#">No Branches yet...</a></li>
                        @endforelse


                        @if ($branches->lastPage() > 1)
                            <li>
                                <a href="{{ route('branches') }}">
                                    <span class="d-flex align-items-center justify-content-center">
                                        Show All
                                        <i class="bi bi-chevron-double-right ms-2"></i>
                                    </span>
                                </a>

                            </li>
                        @endif

                    </ul>
                </li>

                <li><a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('contact') }}" class="{{ Route::is('contact') ? 'active' : '' }}">Contact Us</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <button class="search-btn ms-3 px-1 hide-on-large SearchButton {{ Auth::check() ? 'login' : 'not-login' }}">
                    <iconify-icon icon="radix-icons:magnifying-glass" class="m-0 p-0"></iconify-icon>
                </button>
                @auth
                    @if (Auth::user()->hasRole('ADMIN'))
                        <a class="btn-getstarted hide-on-large on-mobile-nav"
                            href="{{ route('admin.dashboard') }}">Dashboard</a>
                    @endif
                    <a href="{{ route('profile.index', Auth::id()) }}" class="px-1 hide-on-large">
                        <img src="{{ Auth::user()->getImageURL() }}" class="nav-profile-image profile-image-preview"
                            alt="Profile Image">
                    </a>
                @endauth

                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </div>
        </nav>

        @guest
        <a class="btn-getstarted me-1 bg-secondary hide-sm-600" href="{{ route('register') }}">SignUp</a>
        <a class="btn-getstarted ms-1" href="{{ route('login') }}">SingIn</a>
        <button class="search-btn ms-3 hide-on-sm SearchButton">
            <iconify-icon icon="radix-icons:magnifying-glass" class="m-0 p-0"></iconify-icon>
        </button>
        @endguest

        @auth

            @if (Auth::user()->hasRole('ADMIN'))
                <a class="btn-getstarted hide-on-sm" href="{{ route('admin.dashboard') }}">Dashboard</a>
            @endif

            <button class="search-btn ms-3 hide-on-sm SearchButton">
                <iconify-icon icon="radix-icons:magnifying-glass" class="m-0 p-0"></iconify-icon>
            </button>

            <a href="{{ route('profile.index', Auth::id()) }}" class="ms-3 hide-on-sm">
                <img src="{{ Auth::user()->getImageURL() }}" class="nav-profile-image  profile-image-preview"
                    alt="Profile Image">
            </a>
        @endauth



    </div>
</header>
