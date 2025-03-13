<div class="card">
    <div class="d-flex card-header justify-content-between align-items-center border-bottom border-dashed">
         <h4 class="card-title">Analytics</h4>

         <div class="dropdown">
              <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false">
                 Download
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                   <!-- item-->
                   <button id="download-analytics-png" class="dropdown-item">PNG</button>
                   <button id="download-analytics-jpeg" class="dropdown-item">JPEG</button>
                   <button id="download-analytics-pdf" class="dropdown-item">PDF</button>

              </div>
         </div>
    </div>
    <div class="card-body pt-0" id="capture">
         <div class="row align-items-center">
              <div class="col-lg-7">

                 <div id="donut-pie-chart" data-donut-chart-keys="{{ json_encode(array_keys($analyticData)) }}" data-donut-chart-values="{{ json_encode(array_values($analyticData)) }}"></div>

              </div>
              <div class="col-lg-5" dir="ltr">
                   <div class="p-3 pb-0">
                        <!-- Country Data -->
                        <div class="d-flex justify-content-between align-items-center">
                             <p class="mb-1">
                                  <iconify-icon icon="line-md:downloading-loop" class="fs-20 align-middle me-1"></iconify-icon> <span class="align-middle">Downloads</span>
                             </p>
                        </div>
                        <div class="row align-items-center mb-3">
                             <div class="col">
                                  <div class="progress progress-soft progress-sm">
                                       <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $percentages['downloads'] }}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                             </div>
                             <div class="col-auto">
                                  <p class="mb-0 fs-13 fw-semibold">{{ $analyticData['downloads'] }}</p>
                             </div>
                        </div>

                        <!-- Country Data -->
                        <div class="d-flex justify-content-between align-items-center">
                             <p class="mb-1">
                                  <iconify-icon icon="stash:user-heart" class="fs-20 align-middle me-1"></iconify-icon> <span class="align-middle">Subscribers</span>
                             </p>
                        </div>
                        <div class="row align-items-center mb-3">
                             <div class="col">
                                  <div class="progress progress-soft progress-sm">
                                       <div class="progress-bar bg-info" role="progressbar" style="width: {{ $percentages['subscribers'] }}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                             </div>
                             <div class="col-auto">
                                  <p class="mb-0 fs-13 fw-semibold">{{ $analyticData['subscribers'] }}</p>
                             </div>
                        </div>

                        <!-- Country Data -->
                        <div class="d-flex justify-content-between align-items-center">
                             <p class="mb-1">
                                  <iconify-icon icon="line-md:phone-call-loop" class="fs-20 align-middle me-1"></iconify-icon> <span class="align-middle">Contacts</span>
                             </p>
                        </div>
                        <div class="row align-items-center mb-3">
                             <div class="col">
                                  <div class="progress progress-soft progress-sm">
                                       <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentages['contacts'] }}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                             </div>
                             <div class="col-auto">
                                  <p class="mb-0 fs-13 fw-semibold">{{ $analyticData['contacts'] }}</p>
                             </div>
                        </div>

                        <!-- Country Data -->
                        <div class="d-flex justify-content-between align-items-center">
                             <p class="mb-1">
                                  <iconify-icon icon="meteocons:star-fill" class="fs-25 align-middle me-1"></iconify-icon> <span class="align-middle">Reviews</span>
                             </p>
                        </div>
                        <div class="row align-items-center">
                             <div class="col">
                                  <div class="progress progress-soft progress-sm">
                                       <div class="progress-bar bg-progress-4" role="progressbar" style="width: {{ $percentages['reviews'] }}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                             </div>
                             <div class="col-auto">
                                  <p class="mb-0 fs-13 fw-semibold">{{ $analyticData['reviews'] }}</p>
                             </div>
                        </div>
                   </div>
              </div>
         </div>
    </div> <!-- end card-body-->
</div>
