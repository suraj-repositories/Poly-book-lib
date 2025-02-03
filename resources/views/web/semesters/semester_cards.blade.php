<div class="row row-cols-1 row-cols-lg-2 g-4">

    @forelse ([1, 2, 3, 5, 6, 7] as $item) {{-- Replace this with your actual loop using data from database --}}
        <div class="col">
            <div class="service-box semester-card card-shadow rounded-0">
                <div class="card-body">
                    <div class="image-with-title">
                        <div class="img-alt">
                            <iconify-icon icon="vscode-icons:folder-type-log-opened"></iconify-icon>
                        </div>
                        <a href=""> {{-- Add the correct link here --}}
                            <div class="title-area">
                                <div class="title">Semester {{ $item }}</div> {{-- Make this dynamic --}}
                                <div class="sub-title">6 months</div> {{-- Make this dynamic if possible --}}
                            </div>
                        </a>
                    </div>

                    <div class="actions">
                        <iconify-icon icon="solar:notebook-broken"></iconify-icon>
                        <span class="fw-bold mx-1">12</span> {{-- Make this dynamic if possible --}}
                    </div>
                </div>
            </div>
        </div>
    @empty
        @include('layout.no_data')
    @endforelse

</div>
