<!DOCTYPE html>
<html lang="en">
{{-- Author : Mustavid --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Mustavid" />
    <meta name="copyright" content="Mustavid" />
    <title>Data @yield('title')</title>
    @vite('resources/js/app.js')

    <!-- Google Font: Source Sans Pro -->
    
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    
    <!-- Tempusdominus Bootstrap 5 -->
    
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    

    @yield('style')

    <!--Favicon-->
    {{-- <link rel="icon" href="{{ asset('assets/favicon/favicon.ico') }}" type="image/x-icon"> --}}
    <link rel="icon" href="{{ asset('logo.webp') }}" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
        href="{{ asset('assets/favicon/apple-touch-icon-57x57.webp') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('assets/favicon/apple-touch-icon-114x114.webp') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('assets/favicon/apple-touch-icon-72x72.webp') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('assets/favicon/apple-touch-icon-144x144.webp') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
        href="{{ asset('assets/favicon/apple-touch-icon-60x60.webp') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="{{ asset('assets/favicon/apple-touch-icon-120x120.webp') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
        href="{{ asset('assets/favicon/apple-touch-icon-76x76.webp') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="{{ asset('assets/favicon/apple-touch-icon-152x152.webp') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon/favicon-196x196.webp') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon/favicon-96x96.webp') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon/favicon-32x32.webp') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon/favicon-16x16.webp') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon/favicon-128.webp') }}" sizes="128x128" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/favicon/mstile-144x144.webp') }}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('assets/favicon/mstile-70x70.webp') }}" />
    <meta name="msapplication-square150x150logo" content="{{ asset('assets/favicon/mstile-150x150.webp') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ asset('assets/favicon/mstile-310x150.webp') }}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('assets/favicon/mstile-310x310.webp') }}" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand fixed-top" style="background-color: #0053a6">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="user-panel d-flex">
                        <div class="image">
                            @if (Auth::user()->foto_user != null)
                                <img src="{{ asset('assets/profile/' . Auth::user()->foto_user) }}"
                                    class="img-circle elevation-2" alt="User Image"
                                    style="width: 35px; height: 35px; object-fit: cover; object-position: center; border-radius: 50%;">
                            @else
                                <img src="{{ asset('assets/profile/default.webp') }}" class="img-circle elevation-2"
                                    alt="User Image">
                            @endif
                        </div>
                        <div class="info">
                            <a href="#" class="d-block text-white">{{ auth()->user()->name }}</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4" style="background-color: #0053a6">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('logo.png') }}" alt="Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <h4 class="brand-text font-weight-bold text-white">SIMAPS</h4>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->


                @include('layouts.admin.menu')
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper mt-5 pt-3"
            style="background-image: url('{{ asset('assets/img/bg.jpg') }}'); background-size: 165%; background-repeat: no-repeat; background-position: right;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="ml-2">
                                @yield('backlink')@yield('title')
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid mb-5">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer fixed-bottom">
            <strong>Copyright &copy; 2024 <a href="#">MKU</a>.</strong>
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    {{-- script js bootstrap 5 --}}
    @yield('script')
</body>

</html>
