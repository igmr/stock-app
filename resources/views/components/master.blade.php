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
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
    <style>
        .layout-boxed {
            background-color: #001f3f!important;
        }

        .card,
        .navbar-subtitle {
            border-radius: 10px;
        }

        .card>.bg-navy {
            border-radius: 10px 10px 0px 0px;
        }

        .nav-header {
            background-color: #242b33 !important;
            color: #777777 !important;
        }

        .products-list .product-info{
            margin-left: 0px !important;
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
    <!-- AdminLTE App -->
    <script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>
    <!-- Custom JS -->
    {{ $customJS ?? '' }}
</body>

</html>
