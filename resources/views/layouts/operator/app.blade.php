<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Operator | @yield('title')</title>
        @vite('resources/js/app.js')

        <!-- Google Font: Source Sans Pro -->
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">

        <!--Favicon-->
        <link rel="icon" href="{{ asset('logo.webp') }}" type="image/x-icon">
            

        @yield('style')

        <!--Favicon-->
        {{--
        <link
            rel="icon"
            href="{{ asset('assets/favicon/favicon.ico') }}"
            type="image/x-icon"
        />
        --}}
        <link rel="icon" href="{{ asset('logo.webp') }}" type="image/x-icon" />
    </head>

    <body class="layout-fixed">
        <div class="wrapper">
            <!-- Content Wrapper. Contains page content -->
            <div
                class="content-wrapper"
                style="margin: 0; right:0 background-color: #ffffff;"
            >
                <!-- Main content -->
                <section class="content" style="position: relative">
                    <div class="container-fluid">@yield('content')</div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- ./wrapper -->

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
        @vite('resources/js/layout.js')
        @yield('script')
    </body>
</html>
