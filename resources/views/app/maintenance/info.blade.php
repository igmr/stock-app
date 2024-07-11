@php
    $menu        = $data['menu'];
    $maintenance = $data['maintenance'];
@endphp
<x-master>
    @slot('menu', $menu)

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle shadow-lg">
                <!-- Left navbar links -->
                <div class="navbar-nav">
                    <div class="nav-item">
                        <i class="fas fa-tools mr-1"></i>
                        Info maintenance
                    </div>
                </div>
                <!-- Right navbar links -->
                <div class="navbar-nav ml-auto">
                    <div class="nav-item">
                        <a href="{{ route('app.maintenance.index') }}" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-backspace"></i> Back
                        </a>
                    </div>
                </div>
            </nav>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card shadow-lg">
                <div class="card-body table-responsive">
                    <table id="table-maintenance" class="table table-striped table-bordered table-hover"></table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
</x-master>
