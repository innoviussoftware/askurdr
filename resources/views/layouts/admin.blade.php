<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Askurdr Admin</title>
  <!-- Scripts -->
  <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>
  </script>

  @include('admin.includes.css_general')
<script src="{!! asset('public/admin_assets/vendor/jquery/jquery.min.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('public/admin_assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">

<script src="{!! asset('public/admin_assets/moment/min/moment.min.js') !!}"></script>
<script src="{!! asset('public/admin_assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    @include('admin.includes.sidebar')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      @include('admin.includes.topbar')

      @yield('content')

      <!-- Footer -->
      @include('admin.includes.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
@include('admin.includes.javascript_general')
@yield('custom_js')
</body>

</html>