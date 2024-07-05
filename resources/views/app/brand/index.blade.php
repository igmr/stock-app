@php
    $menu = $data['menu'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            let base_url = document.querySelector('meta[name="base_url"]').content;
            let token = document.querySelector('meta[name="csrf-token"]').content;
            let url = `${base_url}/app/brand/datatable`;
            let table = null;
            const btnTrash = async (brand_id) => {
                const url = `${base_url}/app/brand/${brand_id}`;
                const request = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-Token': token,
                    }
                });
                const response = await request.json();
                console.log(response);
                if (response.success) {
                    table.ajax.reload();
                }
                return;
            }

            (() => {
                table = $('#table-brand').DataTable({
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
                            title: 'Brand',
                            data: 'description',
                            width: '1000%',
                        },
                        {
                            title: 'User',
                            data: 'user.name',
                        },
                        {
                            title: 'Actions',
                            data: null,
                            render: (data) => {
                                if (data.id == 1) {
                                    return '';
                                }
                                return `<div class="btn-group">
                                    <a href="${base_url}/app/brand/${data.id}/edit" @class(['btn', 'btn-outline-warning', 'btn-sm'])
                                        data-toggle="tooltip" data-placement="top" title="Edit brand - ${data.description}"><i
                                        @class(['fa', 'fa-edit'])></i></a>
                                    <button type="button" @class(['btn', 'btn-outline-danger', 'btn-sm']) onClick="btnTrash(${data.id})"
                                        data-toggle="tooltip" data-placement="top" title="Delete brand - ${data.description}"><i
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
            <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle">
                <!-- Left navbar links -->
                <div class="navbar-nav">
                    <div class="nav-item">
                        <i class="fab fa-qq mr-1"></i>
                        Brands
                    </div>
                </div>
                <!-- Right navbar links -->
                <div class="navbar-nav ml-auto">
                    <div class="nav-item">
                        <a href="{{ route('app.brand.create') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-plus"></i> New brand
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
                    <table id="table-brand" class="table table-striped table-bordered table-hover"></table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
</x-master>
