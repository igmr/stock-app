<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Authorization | {{ env('APP_NAME') }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">

    <style>
        .dark-mode {
            background: url({{ url('assets/img/backgroup-noise-200x200.png') }}) repeat fixed;
        }

        .card {
            border-radius: 10px;
        }

        .login-box-msg>i {
            font-size: 100px;
        }

        .title-color {
            background: -moz-linear-gradient(top, #d71fef 0%, #0083f5 100%);
            background: -webkit-linear-gradient(top, #d71fef 0%, #0083f5 100%);
            background: linear-gradient(to right, #d71fef 0%, #0083f5 100%);
            -webkit-background-clip: text;
            -moz-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-box-msg>p {
            font-size: 40px;
        }
    </style>

</head>

<body class="hold-transition login-page dark-mode">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline">
            <div class="card-body">
                <!--
                <img src="{{ url('assets/img/logo-black.png') }}" alt="Inductotherm Heating & Welding Mexico"
                    width="100%">
                -->
                <div class="login-box-msg">
                    <i class="fas fa-tint title-color"></i>
                    <br>
                    <p>Sto<b class="title-color">CK</b></p>
                </div>
                <br />
                <form action="{{ route('auth.login.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <input type="email" class="form-control" placeholder="demo@demo.com" name="email"
                                value="demo@demo.com" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="password"
                                value="Password#321" id="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary btn-block">Sign In</button>
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
    <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
