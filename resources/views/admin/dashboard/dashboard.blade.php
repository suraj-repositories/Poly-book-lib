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

                                       <div class="alert alert-warning mt-3 text text-truncate text-center mb-0" role="alert">
                                        Monitor your performance effortlessly with real-time insights, trends, and key metrics to stay ahead.
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
                                        <x-no-data  icon="solar:users-group-rounded-broken" text="No Record" />
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

            <x-analysis-pie-chart-card />

         </div> <!-- end col-->

         <div class="col-lg-6">
              @include('admin.dashboard.popular_books')
         </div>
    </div> <!-- end row-->

</div>

@endsection
