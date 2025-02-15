@extends('admin.layout.layout')
@section('title', Route::is('admin.dashboard') ? 'Dashboard' : '')

@section('content')
<div class="container-fluid">

    <!-- Start here.... -->

   <x-dashboard-analysis-cards/>


    <!-- end row -->

    <div class="row">
         <div class="col">
              <div class="card">
                   <div class="card-body p-0">
                        <div class="row g-0">
                             <div class="col-lg-3">

                                <x-memory-monitor />

                             </div> <!-- end left chart card -->
                             <div class="col-lg-6 border-start border-end">
                                  <div class="p-3">
                                       <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="card-title">Performance</h4>
                                            <div class="period-buttons">
                                                 {{-- <button type="button" id="all-time" class="btn btn-sm btn-outline-light">ALL</button> --}}
                                                 <button type="button" id="one-month" class="btn btn-sm btn-outline-light">1M</button>
                                                 <button type="button" id="six-month" class="btn btn-sm btn-outline-light">6M</button>
                                                 <button type="button" id="one-year" class="btn btn-sm btn-outline-light active">1Y</button>
                                            </div>
                                       </div> <!-- end card-title-->

                                       <div class="alert alert-warning mt-3 text text-truncate mb-0" role="alert">
                                            We regret to inform you that our server is currently experiencing technical difficulties.
                                       </div>

                                       <div dir="ltr">
                                           <x-performance-chart />
                                       </div>
                                  </div>
                             </div> <!-- end right chart card -->

                             <div class="col-lg-3 top-users">
                                  <h5 class="card-title p-3">Top Users</h5>
                                  <div class="px-3" data-simplebar style="max-height: 310px;">

                                    @forelse ($topUsers as $user)
                                        <div class="d-flex justify-content-between align-items-center p-2">
                                            <span class="align-middle fw-medium">{{$user->name}}</span>
                                            <span class="fw-semibold text-muted">
                                                {{ $user->downloads_count }}
                                                <iconify-icon icon="solar:download-minimalistic-broken"></iconify-icon>

                                            </span>
                                    </div>

                                    @empty
                                        @include('layout.no_data')
                                    @endforelse


                                  </div>
                                  <div class="text-center p-3 position-absolute bottom-0 w-100">
                                       <a href="{{ route('admin.users.index') }}" class="btn btn-light shadow-none w-100">View All</a>
                                  </div> <!-- end row -->
                             </div>
                        </div> <!-- end chart card -->
                   </div> <!-- end card body -->
              </div> <!-- end card -->
         </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
         <div class="col-lg-6">
              <div class="card">
                   <div class="d-flex card-header justify-content-between align-items-center border-bottom border-dashed">
                        <h4 class="card-title">Sessions by Country</h4>
                        <div class="dropdown">
                             <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false">
                                  View Data
                             </a>
                             <div class="dropdown-menu dropdown-menu-end">
                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item">Export</a>
                                  <!-- item-->
                                  <a href="javascript:void(0);" class="dropdown-item">Import</a>
                             </div>
                        </div>
                   </div>

                   <div class="card-body pt-0">
                        <div class="row align-items-center">
                             <div class="col-lg-7">
                                  <div id="world-map-markers" class="mt-3" style="height: 220px">
                                  </div>
                             </div>
                             <div class="col-lg-5" dir="ltr">
                                  <div class="p-3 pb-0">
                                       <!-- Country Data -->
                                       <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1">
                                                 <iconify-icon icon="circle-flags:us" class="fs-16 align-middle me-1"></iconify-icon> <span class="align-middle">United States</span>
                                            </p>
                                       </div>
                                       <div class="row align-items-center mb-3">
                                            <div class="col">
                                                 <div class="progress progress-soft progress-sm">
                                                      <div class="progress-bar bg-secondary" role="progressbar" style="width: 82.05%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                                 </div>
                                            </div>
                                            <div class="col-auto">
                                                 <p class="mb-0 fs-13 fw-semibold">659k</p>
                                            </div>
                                       </div>

                                       <!-- Country Data -->
                                       <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1">
                                                 <iconify-icon icon="circle-flags:ru" class="fs-16 align-middle me-1"></iconify-icon> <span class="align-middle">Russia</span>
                                            </p>
                                       </div>
                                       <div class="row align-items-center mb-3">
                                            <div class="col">
                                                 <div class="progress progress-soft progress-sm">
                                                      <div class="progress-bar bg-info" role="progressbar" style="width: 70.5%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                                 </div>
                                            </div>
                                            <div class="col-auto">
                                                 <p class="mb-0 fs-13 fw-semibold">485k</p>
                                            </div>
                                       </div>

                                       <!-- Country Data -->
                                       <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1">
                                                 <iconify-icon icon="circle-flags:cn" class="fs-16 align-middle me-1"></iconify-icon> <span class="align-middle">China</span>
                                            </p>
                                       </div>
                                       <div class="row align-items-center mb-3">
                                            <div class="col">
                                                 <div class="progress progress-soft progress-sm">
                                                      <div class="progress-bar bg-warning" role="progressbar" style="width: 65.8%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                                 </div>
                                            </div>
                                            <div class="col-auto">
                                                 <p class="mb-0 fs-13 fw-semibold">355k</p>
                                            </div>
                                       </div>

                                       <!-- Country Data -->
                                       <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1">
                                                 <iconify-icon icon="circle-flags:ca" class="fs-16 align-middle me-1"></iconify-icon> <span class="align-middle">Canada</span>
                                            </p>
                                       </div>
                                       <div class="row align-items-center">
                                            <div class="col">
                                                 <div class="progress progress-soft progress-sm">
                                                      <div class="progress-bar bg-success" role="progressbar" style="width: 55.8%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                                 </div>
                                            </div>
                                            <div class="col-auto">
                                                 <p class="mb-0 fs-13 fw-semibold">204k</p>
                                            </div>
                                       </div>
                                  </div>
                             </div>
                        </div>
                   </div> <!-- end card-body-->
              </div> <!-- end card-->
         </div> <!-- end col-->

         <div class="col-lg-6">
              @include('admin.dashboard.popular_books')
         </div>
    </div> <!-- end row-->

</div>

@endsection
