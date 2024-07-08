@php
    $menu = $data['menu'];
    $topTeen = $data['topTeen'];
    $listStockMin = $data['listStockMin'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            let base_url = document.querySelector('meta[name="base_url"]').content;
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
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-navy">
                            <h3 class="card-title"><i class="fas fa-exchange-alt mr-1"></i> Recently operations</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Cartridge</th>
                                        <th style="width: 99px;">Date at</th>
                                        <th style="width: 10px;">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topTeen as $item)
                                        @php
                                            $dateAt = date('Y-m-d', strtotime($item->created_at));
                                            $color = 'danger';
                                            if ($item->type == 1) {
                                                $color = 'success';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $item->cartridge }}</td>
                                            <td>{{ $dateAt }}</td>
                                            <td><span class="badge bg-{{ $color }}">{{ $item->_quantity }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-navy">
                            <h3 class="card-title"><i class="fas fa-exchange-alt mr-1"></i> Recently operations</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Model</th>
                                        <th>Cartridge</th>
                                        <th style="width: 10px;">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listStockMin as $item)
                                        <tr>
                                            <td>{{ $item->model }}</td>
                                            <td>{{ $item->cartridge }}</td>
                                            <td>{{ $item->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                                {{ $listStockMin->links() }}
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</x-master>
