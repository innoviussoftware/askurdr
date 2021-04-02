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


</head>

<body class="bg-gradient-primary">

  <div class="container">

  @yield('content')

  </div>
  
  @include('admin.includes.javascript_general')

</body>

</html>
