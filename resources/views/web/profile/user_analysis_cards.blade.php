<div class="container">
    <div class="row row-cols-md-2 row-cols-lg-3 g-3 mt-3">
        <div class="col">
            <div class="card card-shadow border-0 p-3">
                <div class="d-flex mb-2 align-items-center">
                    <iconify-icon icon="solar:download-minimalistic-line-duotone"
                        class="fs-3 fw-bold text-primary me-2"></iconify-icon>
                    <h3>{{ count($user->downloads ?? []) }}</h3>
                </div>
                <h5> Downloads</h5>
            </div>
        </div>
        <div class="col">
            <div class="card card-shadow border-0 p-3">
                <div class="d-flex mb-2 align-items-center">
                    <iconify-icon icon="solar:floor-lamp-line-duotone"
                        class="fs-3 fw-bold text-dark me-2"></iconify-icon>
                    <h3>{{ $exploredBranches }}</h3>
                </div>
                <h5> Explored Branches</h5>
            </div>
        </div>
        <div class="col">
            <div class="card card-shadow border-0 p-3">
                <div class="d-flex mb-2 align-items-center">
                    <iconify-icon icon="solar:star-bold-duotone" class="fs-3 fw-bold text-warning me-2"></iconify-icon>
                    <h3> {{ count($user->reviews ?? []) }} </h3>
                </div>
                <h5> Your Feedbacks</h5>
            </div>
        </div>


    </div>
</div>
