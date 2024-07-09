@php
    $menu = $data['menu'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            let base_url = document.querySelector('meta[name="base_url"]').content;
            let url_stock = `${base_url}/app/report/_stock`;
            let url_stock_min = `${base_url}/app/report/_stock_min`;

            (() => {
                $('#table-stock-min').DataTable({
                    progressing: true,
                    autoWidth: false,
                    pageLength: 4,
                    scrollX: true,
                    scrollY: true,
                    lengthMenu: [
                        [4, 8, 16, -1],
                        [4, 8, 16, 'All']
                    ],
                    ajax: url_stock_min,
                    columns: [{
                            title: 'Model',
                            data: 'cartridge_model',
                        },
                        {
                            title: 'Cartridge',
                            data: 'cartridge',
                        },
                        {
                            title: 'Printer',
                            data: 'printer',
                        },
                        {
                            title: 'Color',
                            className: 'text-center',
                            data: null,
                            render: (data) => {
                                color = data.color;
                                if (color == 'Magenta') {
                                    return ` <i class="fas fa-tint fa-palette" style="color: #f012be"></i>`;
                                }
                                if (color == 'Negro' || color == 'Black') {
                                    return ` <i class="fas fa-tint fa-palette" style="color: #000000"></i>`;
                                }
                                if (color == 'Amarillo' || color == 'Yellow') {
                                    return ` <i class="fas fa-tint fa-palette" style="color: #ffc107"></i>`;
                                }
                                if (color == 'Cian' || color == 'Blue') {
                                    return ` <i class="fas fa-tint fa-palette" style="color: #3c8dbc"></i>`;
                                }
                                return `${color == null ? '': $color}`;
                            }
                        },
                        {
                            title: 'Qty',
                            className: 'text-right',
                            data: null,
                            render: ({
                                quantity
                            }) => {
                                let color = 'success';
                                if (quantity <= 1) {
                                    color = 'warning';
                                }
                                if (quantity <= 0) {
                                    color = 'danger';
                                }
                                return `<span class="badge badge-${color}"> ${quantity}</span>`;
                            }
                        },
                    ]
                });
                $('#table-stock').DataTable({
                    progressing: true,
                    autoWidth: false,
                    pageLength: 4,
                    scrollX: true,
                    scrollY: true,
                    lengthMenu: [
                        [4, 8, 16, -1],
                        [4, 8, 16, 'All']
                    ],
                    ajax: url_stock,
                    columns: [{
                            title: 'Cartridge',
                            data: 'cartridge'
                        },
                        {
                            title: 'Printer',
                            data: 'printer',
                        },
                        {
                            title: 'Color',
                            className: 'text-center',
                            data: null,
                            render: (data) => {
                                color = data.color;
                                if (color == 'Magenta') {
                                    return ` <i class="fas fa-tint fa-palette" style="color: #f012be"></i>`;
                                }
                                if (color == 'Negro' || color == 'Black') {
                                    return ` <i class="fas fa-tint fa-palette" style="color: #000000"></i>`;
                                }
                                if (color == 'Amarillo' || color == 'Yellow') {
                                    return ` <i class="fas fa-tint fa-palette" style="color: #ffc107"></i>`;
                                }
                                if (color == 'Cian' || color == 'Blue') {
                                    return ` <i class="fas fa-tint fa-palette" style="color: #3c8dbc"></i>`;
                                }
                                return `${color == null ? '': $color}`;

                            }
                        },
                        {
                            title: 'Stock',
                            className: 'text-right',
                            data: null,
                            render: (data) => {
                                let stock = data.stock;
                                let color = 'success';
                                if (stock <= 1) {
                                    color = 'warning';
                                }
                                if (stock <= 0) {
                                    color = 'danger';
                                }
                                return `<span class="badge badge-${color}"> ${stock}</span>`;
                            }
                        },
                    ],
                    order: [
                        [0, 'ASC']
                    ],
                });
            })()
        </script>
    @endslot

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle">
                <!-- Left navbar links -->
                <div class="navbar-nav">
                    <div class="nav-item">
                        <i class="fas fa-tachometer-alt mr-1"></i>
                        Dashboard
                    </div>
                </div>
            </nav>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-navy">
                            <h3 class="card-title"><i class="fas fa-sort mr-1"></i> Create orders</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="table-stock-min" class="table table-striped table-bordered table-hover"></table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-12 -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-navy">
                            <h3 class="card-title"><i class="fas fa-cubes mr-1"></i> Stock</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="table-stock" class="table table-striped table-bordered table-hover"></table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</x-master>
