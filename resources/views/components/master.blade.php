<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_url" content="{{ env('APP_URL') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | {{ env('APP_NAME') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- DatePicker -->
    <link rel="stylesheet"
        href="{{ url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('assets/plugins/sweetalert2-11.12.4/dist/sweetalert2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
    <style>
        html {
            color-scheme: dark;
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

        .layout-boxed {
            background: url({{ url('assets/img/backgroup-noise-200x200.png') }}) repeat fixed;
        }

        .card,
        .navbar-subtitle {
            border-radius: 15px;
        }

        .border-full {
            border-radius: 15px;
        }

        .card>.bg-navy {
            border-radius: 15px 15px 0px 0px;
        }

        .nav-header {
            background-color: #22272a !important;
            color: #ffffff !important;
            border-bottom: 1px solid #6e7379;
        }

        .products-list .product-info {
            margin-left: 0px !important;
        }

        [class*=sidebar-dark-] {
            background-color: #272c30 !important;
        }

        .dark-mode .main-footer {
            background-color: #272c30;
            border-color: #4b545c;
        }

        .dark-mode .card {
            background-color: #22272a;
            color: #fff;
        }

        .bg-dark {
            background-color: #272c30 !important;
        }

        .nav-icon {
            color: #bec5cb !important;
        }

        .dark-mode .content-wrapper {
            background-color: #313437;
            color: #fff;
            padding-top: 10px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .small-box h4 {
            font-size: 2rem;
            font-weight: 400;
            margin: 0 0 10px;
            padding: 0;
            white-space: nowrap;
        }

        .icon-black {
            color: rgb(255 249 249 / 15%) !important;
        }

    </style>
</head>

<body class=" sidebar-mini layout-boxed control-sidebar-slide-open dark-mode">
    <!-- Site wrapper -->
    <div class="wrapper">
        <x-navbar />
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <x-aside>
            @slot('menu', $menu)
        </x-aside>
        <!-- /.aside -->

        <!-- Content Wrapper. Contains page content -->
        {{ $slot }}
        <!-- /.content-wrapper -->

        <x-footer />
        <!-- /.footer -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTable -->
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- DatePicker -->
    <script src="{{ url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ url('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ url('assets/plugins/sweetalert2-11.12.4/dist/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>
    <!-- Custom JS -->
    {{ $customJS ?? '' }}
</body>

</html>
