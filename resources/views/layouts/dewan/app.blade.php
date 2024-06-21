<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dewan | @yield('title')</title>
        @vite('resources/js/app.js')

        <link rel="stylesheet" href="{{url('assets/css/juri-tanding.css')}}" />
        <link rel="stylesheet" href="{{url('assets/css/juri-tunggal.css')}}">

        <!-- Google Font: Source Sans Pro -->

        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}"
        />
        <!-- Ionicons -->

        <!-- iCheck -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"
        />
        <!-- JQVMap -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}"
        />
        <!-- Theme style -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/dist/css/adminlte.min.css') }}"
        />
        <!-- SweetAlert2 -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}"
        />
        <!-- overlayScrollbars -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"
        />
        <!-- Daterange picker -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}"
        />
        <!-- summernote -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}"
        />
        

        @yield('style')

        <!--Favicon-->
        {{--
        <link
            rel="icon"
            href="{{ asset('assets/favicon/favicon.ico') }}"
            type="image/x-icon"
        />
        --}}
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon" />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="57x57"
            href="{{ asset('assets/favicon/apple-touch-icon-57x57.png') }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="114x114"
            href="{{ asset('assets/favicon/apple-touch-icon-114x114.png') }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="72x72"
            href="{{ asset('assets/favicon/apple-touch-icon-72x72.png') }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="144x144"
            href="{{ asset('assets/favicon/apple-touch-icon-144x144.png') }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="60x60"
            href="{{ asset('assets/favicon/apple-touch-icon-60x60.png') }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="120x120"
            href="{{ asset('assets/favicon/apple-touch-icon-120x120.png') }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="76x76"
            href="{{ asset('assets/favicon/apple-touch-icon-76x76.png') }}"
        />
        <link
            rel="apple-touch-icon-precomposed"
            sizes="152x152"
            href="{{ asset('assets/favicon/apple-touch-icon-152x152.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('assets/favicon/favicon-196x196.png') }}"
            sizes="196x196"
        />
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('assets/favicon/favicon-96x96.png') }}"
            sizes="96x96"
        />
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('assets/favicon/favicon-32x32.png') }}"
            sizes="32x32"
        />
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('assets/favicon/favicon-16x16.png') }}"
            sizes="16x16"
        />
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('assets/favicon/favicon-128.png') }}"
            sizes="128x128"
        />
        <meta
            name="msapplication-TileImage"
            content="{{ asset('assets/favicon/mstile-144x144.png') }}"
        />
        <meta
            name="msapplication-square70x70logo"
            content="{{ asset('assets/favicon/mstile-70x70.png') }}"
        />
        <meta
            name="msapplication-square150x150logo"
            content="{{ asset('assets/favicon/mstile-150x150.png') }}"
        />
        <meta
            name="msapplication-wide310x150logo"
            content="{{ asset('assets/favicon/mstile-310x150.png') }}"
        />
        <meta
            name="msap  plication-square310x310logo"
            content="{{ asset('assets/favicon/mstile-310x310.png') }}"
        />
    </head>

    <body class="layout-fixed">
        <div class="wrapper">
            <!-- Content Wrapper. Contains page content -->
            <div
                class="content-wrapper"
                style="margin: 0; right:0 background-color: #ffffff;"
            >

                <!-- Main content -->
                <section class="content pl-5 pr-5" style="position: relative">
                    <div class="container-fluid mb-5">@yield('content')</div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        @livewireScripts

        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge("uibutton", $.ui.button);
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
