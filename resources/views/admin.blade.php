<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Admin Dashboard')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- AdminLTE CSS -->
  <link href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('adminlte/dist/css/adminlte.min.css') }}" rel="stylesheet">
  
  @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('partials.navbar')

  <!-- Sidebar -->
  @include('partials.sidebar')

  <!-- Content -->
  <div class="content-wrapper">
    <section class="content p-3">
      @yield('content')
    </section>
  </div>

  <!-- Footer -->
  @include('partials.footer')

</div>

<!-- Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
@yield('scripts')

</body>
</html>
