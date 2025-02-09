<div class="service-box semester-card card-shadow rounded-0" style="border: none">
    <div class="card-body">
        <div class="image-with-title">
            <div class="img-alt">
                @if ($semester->image)
                    <img src="{{ $semester->getImageUrl() }}"
                        alt="Semester-card-{{ $semester->title }}" />
                @else
                    <iconify-icon icon="vscode-icons:folder-type-log-opened"></iconify-icon>
                @endif
            </div>
            <a href="{{ route('branches.semesters.books',['branch' => $branch , 'semester' => $semester]) }}">
                <div class="title-area">
                    <div class="title">{{ $semester->title }}</div>
                    <div class="sub-title">{{ $semester->sub_title }}</div>
                </div>
            </a>
        </div>

        <div class="actions">
            <iconify-icon icon="solar:notebook-broken"></iconify-icon>
            <span class="fw-bold mx-1">{{ count($semester->onBranchGetbooks($branch->id)) }}</span>
        </div>
    </div>
</div>
