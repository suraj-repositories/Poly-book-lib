<div class="main-nav">
    <!-- Sidebar Logo -->
    @include('layout.components.logo_box')

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:hamburger-menu-broken" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>

        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">Menu</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:home-2-broken"></iconify-icon>
                    </span>
                    <span class="nav-text"> Dashboard </span>
                    {{-- <span class="badge bg-success badge-pill text-end">new</span> --}}
                </a>
            </li>

            <li class="menu-title">Poly</li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.semesters')}}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:clipboard-broken"></iconify-icon>

                    </span>
                    <span class="nav-text"> Semesters </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.branches')}}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:floor-lamp-broken"></iconify-icon>
                    </span>
                    <span class="nav-text">Branches</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarBooks" data-bs-toggle="collapse"
                    role="button" aria-expanded="false" aria-controls="sidebarBooks">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:notebook-broken"></iconify-icon>
                    </span>
                    <span class="nav-text"> Books </span>
                </a>
                <div class="collapse" id="sidebarBooks">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <i class='bx bx-minus'></i>
                            <a class="sub-nav-link" href="{{route('admin.books')}}">Book List</a>
                        </li>
                        <li class="sub-nav-item">
                            <i class='bx bx-minus'></i>
                            <a class="sub-nav-link" href="{{ route('admin.books.create') }}">Add Book</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarFiles" data-bs-toggle="collapse"
                    role="button" aria-expanded="false" aria-controls="sidebarFiles">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:file-broken"></iconify-icon>
                    </span>
                    <span class="nav-text"> Files </span>
                </a>
                <div class="collapse" id="sidebarFiles">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <i class='bx bx-minus'></i>
                            <a class="sub-nav-link" href="{{ route('admin.files') }}">View files</a>
                        </li>
                        <li class="sub-nav-item">
                            <i class='bx bx-minus'></i>
                            <a class="sub-nav-link" href="{{ route('admin.files.create') }}">Upload File</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="menu-title">Public</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:users-group-rounded-broken"></iconify-icon>

                    </span>
                    <span class="nav-text"> Users </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.downloads.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:download-minimalistic-broken"></iconify-icon>

                    </span>
                    <span class="nav-text"> Downloads </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.subscribers.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:user-heart-rounded-broken"></iconify-icon>

                    </span>
                    <span class="nav-text"> Subscribers </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.contacts.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:call-chat-rounded-broken"></iconify-icon>

                    </span>
                    <span class="nav-text">Contacts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reviews.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:star-broken"></iconify-icon>

                    </span>
                    <span class="nav-text">Reviews</span>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{route('logout')}}" method="POST" >
                    @csrf
                    <button class="nav-link w-100" >
                        <span class="nav-icon text-danger fs-3">
                            <i class="bx bx-log-out fs-20"></i>
                        </span>
                        <span class="nav-text text-danger"> Logout </span>
                    </button>
                </form>
            </li>


        </ul>
    </div>
</div>
