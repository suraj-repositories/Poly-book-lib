@include('admin.layout.header')
<body>

     <!-- START Wrapper -->
     <div class="wrapper">

          <!-- ========== Topbar Start ========== -->

          @include('admin.layout.navbar')

          <!-- Right Sidebar (Theme Settings) -->
          @include('admin.layout.right_sidebar')
          <!-- ========== Topbar End ========== -->

          <!-- ========== App Menu Start ========== -->
          @include('admin.layout.sidebar')
          <!-- ========== App Menu End ========== -->

          <!-- ==================================================== -->
          <!-- Start right Content here -->
          <!-- ==================================================== -->
          <div class="page-content">

               <!-- Start Container Fluid -->
              @yield('content')
               <!-- End Container Fluid -->

               <!-- ========== Footer Start ========== -->
               @include('admin.layout.footer')
               <!-- ========== Footer End ========== -->

          </div>
          <!-- ==================================================== -->
          <!-- End Page Content -->
          <!-- ==================================================== -->

        </div>
     </div>
     <!-- END Wrapper -->

   @include('admin.layout.scripts')

</body>

</html>
