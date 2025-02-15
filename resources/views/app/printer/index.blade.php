@php
    $menu = $data['menu'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            let base_url = document.querySelector('meta[name="base_url"]').content;
            let token = document.querySelector('meta[name="csrf-token"]').content;
            let url = `${base_url}/app/printer/datatable`;
            let table = null;

            const btnTrash = (printer_id) => {
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
                        const response = await trash(printer_id);
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

            const trash = async (printer_id) => {
                const url = `${base_url}/app/printer/${printer_id}`;
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
                table = $('#table-printer').DataTable({
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
                            title: 'Printer',
                            data: 'description',
                        },
                        {
                            title: 'Brand',
                            data: null,
                            render: (data) => {
                                const brand = data.brand;
                                if (brand === null) {
                                    return ``;
                                }
                                return brand.description;
                            }
                        },
                        {
                            title: 'Model',
                            data: 'model',
                        },
                        {
                            title: 'Serial',
                            data: 'serial',
                        },
                        {
                            title: 'Actions',
                            data: null,
                            render: (data) => {
                                if (data.id == 1) {
                                    return '';
                                }
                                return `<div class="btn-group">
                                    <a href="${base_url}/app/printer/${data.id}/edit" @class(['btn', 'btn-outline-warning', 'btn-sm'])
                                        data-toggle="tooltip" data-placement="top" title="Edit printer - ${data.description}"><i
                                        @class(['fa', 'fa-edit'])></i></a>
                                    <button type="button" @class(['btn', 'btn-outline-danger', 'btn-sm']) onClick="btnTrash(${data.id})"
                                        data-toggle="tooltip" data-placement="top" title="Delete printer - ${data.description}"><i
                                            @class(['fa', 'fa-trash'])></i></button>
                                </div>`;
                            }
                        }
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
                        <i class="fas fa-print mr-1"></i>
                        Printers
                    </div>
                </div>
                <!-- Right navbar links -->
                <div class="navbar-nav ml-auto">
                    <div class="nav-item">
                        <a href="{{ route('app.printer.create') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-plus"></i> New printer
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
                    <table id="table-printer" class="table table-striped table-bordered table-hover"></table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
</x-master>
