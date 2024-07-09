@php
    $menu = $data['menu'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            let base_url = document.querySelector('meta[name="base_url"]').content;
            let token = document.querySelector('meta[name="csrf-token"]').content;
            let url = `${base_url}/app/maintenance/datatable`;
            let table = null;

            (() => {
                table = $('#table-maintenance').DataTable({
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
                            data: 'printer.model'
                        },
                        {
                            title: 'Printer',
                            data: 'printer.description'
                        },
                        {
                            title: 'Internal',
                            data: null,
                            render: (data) => {
                                return data.internal ? 'Yes' : 'No';
                            }
                        },
                        {
                            title: 'Provider',
                            data: 'user_name'
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
                            title: 'Cost',
                            data: 'cost'
                        },
                        {
                            title: 'Status',
                            data: null,
                            className: 'text-center',
                            render: ({
                                status
                            }) => {
                                if (status == 'Pending') {
                                    return `<span class="badge badge-info"> ${status}</span>`;
                                }
                                if (status == 'Delivery') {
                                    return `<span class="badge badge-success"> ${status}</span>`;
                                }
                                if (status == 'Progress') {
                                    return `<span class="badge badge-warning"> ${status}</span>`;
                                }
                                if (status == 'Cancel') {
                                    return `<span class="badge badge-danger"> ${status}</span>`;
                                }
                                return `${status}`;
                            }
                        },
                        {
                            title: 'Actions',
                            class: 'text-center',
                            data: null,
                            render: (data) => {
                                let status = false;
                                if (data.status == 'Entregado') {
                                    status = true;
                                }
                                if (data.status == 'Delivery') {
                                    status = true;
                                }
                                if (data.status == 'Cancel') {
                                    status = true;
                                }
                                if (status == true) {
                                    return `<a href="${base_url}/app/maintenance/${data.id}/info" @class(['btn', 'btn-outline-info', 'btn-sm'])
                                        data-toggle="tooltip" data-placement="top" title="Info service #${data.id}"><i class="fas fa-info"></i></a>`;
                                } else {

                                    return `
                                    <div class="btn-group">
                                        <a href="${base_url}/app/maintenance/${data.id}/follow" @class(['btn', 'btn-outline-success', 'btn-sm'])
                                        data-toggle="tooltip" data-placement="top" title="Follow service #${data.id}"><i
                                        @class(['fa', 'fa-share'])></i></a>
                                    <a href="${base_url}/app/maintenance/${data.id}/delivery" @class(['btn', 'btn-outline-warning', 'btn-sm'])
                                        data-toggle="tooltip" data-placement="top" title="Finished service #${data.id}"><i
                                        @class(['fa', 'fa-map-pin'])></i></a>
                                    <!--
                                    <a href="${base_url}/app/maintenance/${data.id}/file" @class(['btn', 'btn-outline-info', 'btn-sm'])
                                        data-toggle="tooltip" data-placement="top" title="Add file service #${data.id}"><i
                                        @class(['fa', 'fa-file'])></i></a>
                                    -->
                                    <a href="${base_url}/app/maintenance/${data.id}/cancel" @class(['btn', 'btn-outline-danger', 'btn-sm'])
                                    data-toggle="tooltip" data-placement="top" title="Cancel service #${data.id}"><i
                                    @class(['fas', 'fa-ban'])></i></a>
                                    </div>
                                    `;
                                }
                            }
                        }
                    ],
                    order: [0, 'DESC'],
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
                        <i class="fas fa-tools mr-1"></i>
                        Maintenance
                    </div>
                </div>
                <!-- Right navbar links -->
                <div class="navbar-nav ml-auto">
                    <div class="nav-item">
                        <a href="{{ route('app.maintenance.create') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-plus"></i> New maintenance
                        </a>
                    </div>
                </div>
            </nav>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
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
