@php
    $menu = $data['menu'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            let base_url = document.querySelector('meta[name="base_url"]').content;
            let token = document.querySelector('meta[name="csrf-token"]').content;
            let url = `${base_url}/app/stock/datatable`;
            let table = null;

            const btnTrash = async (stock_id) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then(async result => {
                    if (result.isConfirmed) {
                        const response = await trash(stock_id);
                        if (response.success) {
                            table.ajax.reload();
                            Swal.fire({
                                title: "Deleted!",
                                text: "The record has been deleted.",
                                icon: "success"
                            });
                        }

                    } else if (result.isDenied) {
                        console.log('cancel')
                    }
                });
            }

            const trash = async (stock_id) => {
                const url = `${base_url}/app/stock/${stock_id}`;
                const request = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-Token': token,
                    }
                });
                return await request.json();
            }

            (() => {
                table = $('#table-stock').DataTable({
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
                            title: 'Cartridge',
                            data: null,
                            render: ({
                                cartridge
                            }) => {
                                if (cartridge == null) {
                                    return ``;
                                }
                                return cartridge.description;
                            }
                        },
                        {
                            title: 'Printer',
                            data: null,
                            render: ({
                                cartridge
                            }) => {
                                if (cartridge == null) {
                                    return ``;
                                }
                                if (cartridge.printer == null) {
                                    return ``;
                                }
                                return cartridge.printer.description;
                            }
                        },
                        {
                            title: 'Date',
                            data: null,
                            render: ({
                                created_at
                            }) => {
                                const createdAt = new Date(created_at);
                                const option = {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit',
                                };
                                return `${createdAt.toLocaleDateString('en-CA', option)}`;
                            }
                        },
                        {
                            title: 'Color',
                            className: 'text-center',
                            data: null,
                            render: ({
                                cartridge
                            }) => {
                                if (cartridge == null) {
                                    return ``;
                                }
                                let color = cartridge.color;
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
                                _quantity,
                                type
                            }) => {
                                if (type == 0) {
                                    return `<span class="badge badge-danger"> ${_quantity}</span>`;
                                }
                                if (type == 1) {
                                    return `<span class="badge badge-success"> ${_quantity}</span>`;
                                }
                            }
                        },
                        {
                            title: 'Actions',
                            className: 'text-center',
                            data: null,
                            render: (data) => {
                                return `<div class="btn-group">
                                <button type="button" @class(['btn', 'btn-outline-danger', 'btn-sm']) onClick="btnTrash(${data.id})"
                                    data-toggle="tooltip" data-placement="top" title="Delete stock - ${data.observation}"><i
                                        @class(['fa', 'fa-trash'])></i></button>
                            </div>`;
                            }
                        }
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
            <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle shadow-lg">
                <!-- Left navbar links -->
                <div class="navbar-nav">
                    <div class="nav-item">
                        <i class="fas fa-check-circle mr-1"></i>
                        Stock
                    </div>
                </div>
                <!-- Right navbar links -->
                <div class="navbar-nav ml-auto">
                    <div class="nav-item">
                        <a href="{{ route('app.stock.create') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-plus"></i> New stock
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
                    <table id="table-stock" class="table table-striped table-bordered table-hover"></table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
</x-master>
