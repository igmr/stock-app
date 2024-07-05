@php
    $menu = $data['menu'];
    $topTeen = $data['topTeen'];
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
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach ($topTeen as $item)
                                    @php
                                        $dateAt = date('Y-m-d', strtotime($item->created_at));
                                        $color = 'danger';
                                        if ($item->type == 1) {
                                            $color = 'success';
                                        }
                                    @endphp
                                    <li class="item">
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title">{{ $item->cartridge }}
                                                <span
                                                    class="badge badge-{{$color}} float-right">{{ $item->_quantity }}</span></a>
                                            <span class="product-description">
                                                {{ $dateAt }}
                                            </span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</x-master>
