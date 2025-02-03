<div class="service-box position-relative p-0">
    <div class="branch-img">
        <img src="{{ asset('storage/branches/cBYVUqpzF1B624uj8wGMWAG1oMyxZ9DrYor0qzQL.jpg') }}" alt="Branch"> {{-- Use asset() helper --}}
    </div>

    <div class="p-3">
        <h4>Plastic Mould Technology</h4> {{-- Make this dynamic if possible --}}

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
