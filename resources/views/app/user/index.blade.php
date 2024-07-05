@php
    $menu = $data['menu'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            let base_url = document.querySelector('meta[name="base_url"]').content;
            let url = `${base_url}/app/user/datatable`;
            let table = null;
            (() => {
                table = $('#table-user').DataTable({
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
                            title:'Name',
                            data: 'name'
                        },
                        {
                            title:'Email',
                            data: 'email'
                        },
                        {
                            title: 'Actions',
                            className:'text-center',
                            data: null,
                            render: (data) => {
                                return `<div class="btn-group">
                                    <a href="${base_url}/app/user/${data.id}/edit" @class(['btn', 'btn-outline-warning', 'btn-sm'])
                                        data-toggle="tooltip" data-placement="top" title="Edit user - ${data.name}"><i
                                        @class(['fa', 'fa-edit'])></i></a>
                                    <a href="${base_url}/app/user/${data.id}/change-password" @class(['btn', 'btn-outline-primary', 'btn-sm'])
                                        data-toggle="tooltip" data-placement="top" title="Edit password user - ${data.name}"><i
                                        @class(['fas', 'fa-key'])></i></a>
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
                        <i class="fas fa-users mr-1"></i>
                        Users
                    </div>
                </div>
                <!-- Right navbar links -->
                <div class="navbar-nav ml-auto">
                    <div class="nav-item">
                        <a href="{{ route('app.user.create') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-plus"></i> New user
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
                    <table id="table-user" class="table table-striped table-bordered table-hover"></table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
</x-master>
