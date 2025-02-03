<div class="container">

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4  gy-4">
        @forelse ($branches as $branch)
            <div class="col" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                    <a href="{{ route('branches.show', $branch->id) }}">
                        <div class="pic d-flex justify-content-center">
                            <img src="{{ $branch->getImageUrl() }}"
                                class="img-fluid branch-image" alt="">
                        </div>
                    </a>
                    <div class="member-info">
                        <a href="{{ route('branches.show', $branch->id) }}"><h4>{{ $branch->name }}</h4></a>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="social position-static">
                                <a href="#" class="d-flex align-items-center fs-4">
                                    <iconify-icon icon="solar:download-bold-duotone" class="icon "></iconify-icon>

                                    <span class="fs-6 ms-1">11,156</span>
                                </a>
                            </span>

                            <a href="#" class="d-flex align-items-center fs-4">
                                <iconify-icon icon="solar:notebook-bold-duotone" class="icon "></iconify-icon>
                                <span class="fs-6 ms-1"> {{ count($branch->books) }} </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if ($maxCards && $loop->iteration == $maxCards)
                <div class="col" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-100 d-flex align-items-center justify-content-center h-100 show-all-cardd flex-column">
                        <a href="{{ route('branches') }}">
                            <div class="card p-4 border-0 shadow rounded rounded-circle center-content">
                                <iconify-icon icon="solar:multiple-forward-right-broken" class="fs-1"></iconify-icon>
                            </div>
                        </a>
                        <a href="{{ route('branches') }}" class="mt-3">
                            <span class="fs-4 fw-semibold text-secondary">Show All</span>
                        </a>
                    </div>
                </div>

                @php break; @endphp
            @endif
        @empty

            @include('layout.no_data')
        @endforelse

    </div>

    @if ($isPagination)
        <div class="container mt-4 pt-4">
            {{ $branches->links() }}

        </div>
    @endif

</div>
