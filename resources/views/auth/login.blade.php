<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMAPS - Login</title>
    @vite('resources/js/app.js')

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page"
    style="background-image: url('{{ asset('assets/img/bg.png') }}'); background-size: 50%; background-repeat: no-repeat; background-position: center;">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <div class="d-flex justify-content-around align-items-center">
                    <div class="h3 m-0"><b>SIMAPS</b></div>
                    <a class="btn btn-primary" href="{{ route('penonton') }}"><i
                            class="fas fa-arrow-circle-right mr-1"></i>
                        Penonton</a>
                    <a class="btn btn-primary" href="{{ route('ketuapertandingan') }}"><i
                            class="fas fa-arrow-circle-right mr-1"></i>
                        Ketua</a>
                </div>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('logo.png') }}" alt="" width="200" class="img img-fluid">
                </div>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-eye-slash toggle-password" style="cursor: pointer;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <!-- /.col -->
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <!-- Script to toggle password visibility -->
    <script>
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).parent().parent().prev());
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>
</body>

</html>
