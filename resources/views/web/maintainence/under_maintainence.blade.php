@extends('admin.layout.header')
@section('title', Route::is('web.under_maintainence') ? 'Under Maintainence' : 's')

@include('admin.layout.header')

     <body class="authentication-bg maintainence">

          <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
               <div class="container">
                    <div class="row justify-content-center">
                         <div class="col-xl-12">
                              <div class="card auth-card">
                                   <div class="card-body p-0">
                                        <div class="row align-items-center g-0">
                                             <div class="col-lg-6 d-none d-lg-inline-block border-end">
                                                  <div class="auth-page-sidebar filter-wesite-theme">
                                                       <img src="{{ asset('assets/img/maintainence/under_maintainence.svg') }}" alt="auth" class="img-fluid" />
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <div class="p-4">
                                                        <div class="mx-auto mb-4 text-center auth-logo zoom-img-text">
                                                           @include('layout.components.logo_box')
                                                       </div>
                                                       <h2 class="fw-bold text-center lh-base">We are currently performing maintenance</h2>
                                                       <p class="text-muted text-center mt-1 mb-4">We're making the system more awesome.
                                                            We'll be back shortly.</p>

                                                       <div class="text-center">
                                                            <a href="mailto:{{ Settings::get('contact_email', config('contact_email')) }}" class="btn btn-success">Contact Us</a>
                                                       </div>
                                                  </div>
                                             </div> <!-- end col -->
                                        </div> <!-- end row -->

                                   </div> <!-- end card-body -->
                              </div> <!-- end card -->

                         </div> <!-- end col -->
                    </div> <!-- end row -->
               </div>
          </div>



     </body>

</html>
