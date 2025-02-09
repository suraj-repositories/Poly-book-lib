<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-light bg-opacity-50 rounded">
                            {{-- <iconify-icon icon="solar:leaf-bold-duotone" class="fs-32 text-success avatar-title"></iconify-icon> --}}
                            <iconify-icon icon="solar:layers-bold-duotone"
                                class="fs-32 text-success avatar-title"></iconify-icon>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Books</p>
                        <h3 class="text-dark mt-1 mb-0">{{ number_format($bookCount) }}</h3>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div> <!-- end card body -->
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-{{ $bookCountLastMonth > 0 ? 'success' : 'warning' }}">
                            <i class="bx bxs-{{ $bookCountLastMonth > 0 ? 'up' : 'right' }}-arrow fs-12"></i>
                            {{ $bookCountLastMonth > 0 ? '+' : '' }}{{ number_format($bookCountLastMonth) }}</span>
                        <span class="text-muted ms-1 fs-12">Last Month</span>
                    </div>
                    <a href="{{ route('admin.books') }}" class="text-reset fw-semibold fs-12">View More</a>
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-light bg-opacity-50 rounded">
                            <iconify-icon icon="solar:floor-lamp-line-duotone"
                                class="fs-32 text-success avatar-title"></iconify-icon>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Branches</p>
                        <h3 class="text-dark mt-1 mb-0">{{ number_format($branchCount) }}</h3>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div> <!-- end card body -->
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-{{ $branchCountLastMonth > 0 ? 'success' : 'warning' }}">
                            <i class="bx bxs-{{ $branchCountLastMonth > 0 ? 'up' : 'right' }}-arrow fs-12"></i>
                            {{ $branchCountLastMonth > 0 ? '+' : '' }}{{ $branchCountLastMonth }}</span>
                        <span class="text-muted ms-1 fs-12">Last Month</span>
                    </div>
                    <a href="{{ route('admin.branches') }}" class="text-reset fw-semibold fs-12">View More</a>
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-light bg-opacity-50 rounded">
                            <iconify-icon icon="solar:download-minimalistic-line-duotone"
                                class="fs-32 text-success avatar-title"></iconify-icon>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Downloads</p>
                        <h3 class="text-dark mt-1 mb-0">{{ number_format($downloadCount) }}</h3>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div> <!-- end card body -->
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-{{ $downloadCountLastMonth > 0 ? 'success' : 'warning' }}">
                            <i class="bx bxs-{{ $downloadCountLastMonth > 0 ? 'up' : 'right' }}-arrow fs-12"></i>
                            {{ $downloadCountLastMonth > 0 ? '+' : '' }}{{ number_format($downloadCountLastMonth) }}</span>
                        <span class="text-muted ms-1 fs-12">Last Month</span>
                    </div>
                    <a href="{{ route('admin.downloads.index') }}" class="text-reset fw-semibold fs-12">View More</a>
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-light bg-opacity-50 rounded">
                            <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"
                                class="fs-32 text-success avatar-title"></iconify-icon>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Contacts</p>
                        <h3 class="text-dark mt-1 mb-0">{{ number_format($contactCount) }}</h3>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div> <!-- end card body -->
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="{{ $contactCountLastMonth > 0 ? 'text-success' : 'text-warning' }}">
                            <i class="bx bxs-{{ $contactCountLastMonth > 0 ? 'up' : 'right' }}-arrow fs-12"></i>
                            {{ $contactCountLastMonth > 0 ? '+' : '' }}{{ number_format($contactCountLastMonth) }}
                        </span>
                        <span class="text-muted ms-1 fs-12">Last Month</span>
                    </div>
                    <a href="{{ route('admin.contacts.index') }}" class="text-reset fw-semibold fs-12">View More</a>
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
