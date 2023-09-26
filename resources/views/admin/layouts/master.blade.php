<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin｜{{ config('app.name', 'Laravel') }}</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('templates/admin/plugins/fontawesome-free/css/all.min.css') }}">

  <link rel="stylesheet" href="{{ asset('templates/admin/plugins/toastr/toastr.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('templates/admin/plugins/alertifyjs/css/alertify.min.css') }}" />
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('templates/admin/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('templates/admin/css/style.css') }}">

  <!-- CSRF Token -->
  <meta name="csrf_token" content="{{ csrf_token() }}">

  @stack('head')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('templates/admin/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="javascript:void(0)" class="brand-link">
        <img src="{{ asset('templates/admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">MENU</li>
            <li class="nav-item">
              <a href="{{ route('admin.customers.index') }}" class="nav-link">
                <i class="nav-icon fab fa-wpforms"></i>
                <p>
                  顧客管理一覧
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.applications.index') }}" class="nav-link">
                <i class="nav-icon  fas fa-list-ul"></i>
                <p>
                  お申込み内容一覧
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.master_ads.index') }}" class="nav-link">
                <i class="nav-icon  fas fa-list-ul"></i>
                <p>
                  広告マスター
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.profile') }}" class="nav-link">
                <i class="nav-icon  fas fa-list-ul"></i>
                <p>
                  ログイン情報管理
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  ログアウト
                </p>
              </a>
              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; {{ date('Y') }}.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('templates/admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('templates/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <script src="{{ asset('templates/admin/plugins/toastr/toastr.min.js') }}"></script>

  <script src="{{ asset('templates/admin/plugins/alertifyjs/alertify.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('templates/admin/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('templates/admin/js/script.js') }}"></script>
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
      });
      var origin = window.location.origin;
      var pathname = window.location.pathname;
      const paths = pathname.split("/");
      const activeUrl = `${origin}/${paths[1]}/${paths[2]}`;
      $(`a[href="${activeUrl}"]`).addClass("active");
    });
  </script>
  @if(session()->has('success'))
  <script type="text/javascript">
    toastr.success("{{ session()->get('success') }}", `{{ __("Success") }}`, {
      "positionClass": "toast-bottom-right",
    })
  </script>
  @endif
  @if(session()->has('error'))
  <script type="text/javascript">
    toastr.error("{{ session()->get('error') }}", `{{ __("Error") }}`, {
      "positionClass": "toast-bottom-right",
    })
  </script>
  @endif
  @stack('footer')
</body>

</html>