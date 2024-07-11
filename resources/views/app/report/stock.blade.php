@php
    $menu = $data['menu'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            let base_url = document.querySelector('meta[name="base_url"]').content;
            let url = `${base_url}/app/report/_stock`;

            (() => {
                table = $('#table-report-stock').DataTable({
                    progressing: true,
                    autoWidth: false,
                    pageLength: 4,
                    scrollX: true,
                    scrollY: true,
                    lengthMenu: [
                        [4, 8, 16, -1],
                        [4, 8, 16, 'All']
                    ],
                    ajax: url,
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
                            data: null,
                            render: (data) => {
                                color = data.color;
                                if (color == 'Magenta') {
                                    return `<span class="badge bg-fuchsia color-palette">${color}</span>`;
                                }
                                if (color == 'Negro' || color == 'Black') {
                                    return `<span class="badge bg-black"> ${color}</span>`;
                                }
                                if (color == 'Amarillo' || color == 'Yellow') {
                                    return `<span class="badge bg-warning color-palette"> ${color}</span>`;
                                }
                                if (color == 'Cian' || color == 'Blue') {
                                    return `<span class="badge bg-lightblue color-palette"> ${color}</span>`;
                                }
                                return `${color == null ? '': $color}`;

                            }
                        },
                        {
                            title: 'Stock',
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
            <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle shadow-lg">
                <!-- Left navbar links -->
                <div class="navbar-nav">
                    <div class="nav-item">
                        <i class="fas fa-cubes mr-1"></i>
                        Stock
                    </div>
                </div>
            </nav>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card shadow-lg">
                <div class="card-body table-responsive">
                    <table id="table-report-stock" class="table table-striped table-bordered table-hover"></table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
</x-master>
