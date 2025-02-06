<div class="service-box position-relative p-0">
    <div class="branch-img">
        <img src="{{ $branch->getImageUrl() }}" alt="Branch">
    </div>

    <div class="p-3">
        <h4>{{ $branch->name }}</h4>

        <div class="services-list left-border-links">
            <a href="{{ route('branches.show', $branch) }}" class="{{ Route::is('branches.show') ? 'active' : '' }}">
                <iconify-icon icon="solar:clipboard-broken"></iconify-icon>
                <span class="ms-1">Semesters</span>
            </a>
            <a href="{{ route('branches.books', $branch) }}" class="{{ Route::is('branches.books') ? 'active' : '' }}" >
                <iconify-icon icon="solar:notebook-broken"></iconify-icon>
                <span class="ms-1">Books</span>
            </a>
        </div>
    </div>
</div>
