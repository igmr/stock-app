@php
    $menu = $data['menu'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            let base_url = document.querySelector('meta[name="base_url"]').content;
            let url = `${base_url}/app/report/_history`;

            (() => {
                table = $('#table-report-history').DataTable({
                    progressing: true,
                    autoWidth: false,
                    pageLength: 5,
                    scrollX: true,
                    scrollY: true,
                    lengthMenu: [
                        [5, 10, 20, -1],
                        [5, 10, 20, 'All']
                    ],
                    ajax: url,
                    columns: [{
                            title: '#',
                            data: 'id'
                        },
                        {
                            title: 'Model',
                            data: 'cartridge.model',
                        },
                        {
                            title: 'Cartridge',
                            data: 'cartridge.description',
                        },
                        {
                            title: 'Printer',
                            data: 'cartridge.printer.description',
                        },
                        {
                            title: 'Color',
                            data: null,
                            render: (data) => {
                                color = data.cartridge.color;
                                if (color == 'Magenta') {
                                    return `<span class="badge badge-pill bg-fuchsia color-palette">${color}</span>`;
                                }
                                if (color == 'Negro' || color == 'Black') {
                                    return `<span class="badge badge-pill bg-black"> ${color}</span>`;
                                }
                                if (color == 'Amarillo' || color == 'Yellow') {
                                    return `<span class="badge badge-pill bg-warning color-palette"> ${color}</span>`;
                                }
                                if (color == 'Cian' || color == 'Blue') {
                                    return `<span class="badge badge-pill bg-lightblue color-palette"> ${color}</span>`;
                                }
                                return `${color}`;

                            }
                        },
                        {
                            title: 'Quanityt',
                            className: 'text-right',
                            data: null,
                            render: (data) => {
                                let type = data.type;
                                let quantity = data._quantity;
                                let styleColor = 'danger';
                                if (type == 1) {
                                    styleColor = 'success'
                                }
                                return `<span class="badge badge-${styleColor}"> ${quantity}</span>`;
                            }
                        },
                    ],
                    order: [
                        [0, 'desc']
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
                        <i class="fas fa-book mr-1"></i>
                        History
                    </div>
                </div>
            </nav>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="table-report-history" class="table table-striped table-bordered table-hover"></table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
</x-master>
