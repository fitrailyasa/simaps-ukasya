<!DOCTYPE html>
<html lang="en">
{{-- Author : Mustavid --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Mustavid" />
    <meta name="copyright" content="Mustavid" />
    <title>SIMAPS | @yield('title')</title>
    @yield('style')
    @vite('resources/js/app.js')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">

    <!--Favicon-->
    <link rel="icon" href="{{ asset('logo.webp') }}" type="image/x-icon">

    <style>
        /* Default image size for desktop */
        .img-gallery {
            border-radius: 30px;
            padding: 30px;
            width: 300px;
        }

        /* Tablet view: 768px and below */
        @media (max-width: 768px) {
            .img-gallery {
                border-radius: 20px;
                padding: 20px;
                width: 200px;
            }
        }

        /* Mobile view: 576px and below */
        @media (max-width: 576px) {
            .img-gallery {
                border-radius: 10px;
                padding: 10px;
                width: 100px;
            }
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed bg-gradient">

    {{-- @include('layouts.client.header') --}}

    @yield('content')

    {{-- @include('layouts.client.footer') --}}
    
    <!-- Bootstrap JS and Popper.js -->
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    {{-- script js bootstrap 5 --}}
@livewireScripts
    @yield('script')
</body>

</html>
