@php
    $menu = $data['menu'];
    $maintenance = $data['maintenance'];
    $date_init = '';
    $date_init = date('Y/m/d', strtotime($maintenance->date_init));
    $date_status = '';
    $observation_status = '';
    if ($maintenance->date_finish != '') {
        $date_status = date('Y/m/d', strtotime($maintenance->date_finish));
        $observation_status = $maintenance->observation_finish;
    }
    if ($maintenance->date_cancel != '') {
        $date_status = date('Y/m/d', strtotime($maintenance->date_cancel));
        $observation_status = $maintenance->observation_cancel;
    }
@endphp
<x-master>
    @slot('menu', $menu)

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle shadow-lg">
                <!-- Left navbar links -->
                <div class="navbar-nav">
                    <div class="nav-item">
                        <i class="fas fa-tools mr-1"></i>
                        Info maintenance
                    </div>
                </div>
                <!-- Right navbar links -->
                <div class="navbar-nav ml-auto">
                    <div class="nav-item">
                        <a href="{{ route('app.maintenance.index') }}" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-backspace"></i> Back
                        </a>
                    </div>
                </div>
            </nav>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-lg">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <i class="fas fa-print fa-3x title-color"></i>
                                </div>
                                <h3 class="profile-username text-center">{{ $maintenance->printer->description }}</h3>
                                <p class="text-muted text-center">{{ $maintenance->printer->brand->description }}</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <strong><i class="fas fa-barcode mr-1"></i> Serial</strong>
                                        <div class="text-muted">{{ $maintenance->printer->serial }}</div>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><i class="fas fa-qrcode mr-1"></i> Model</strong>
                                        <div class="text-muted">{{ $maintenance->printer->model }}</div>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><i class="fas fa-location-arrow mr-1"></i> Location</strong>
                                        <div class="text-muted">{{ $maintenance->printer->location }}</div>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow-lg">
                            <div class="card-header p-2 bg-navy">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#general" data-toggle="tab">
                                            <i class="fas fa-bars mr-1"></i>
                                            General
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#status" data-toggle="tab">
                                            <i class="far fa-circle mr-1"></i>
                                            Status
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#follow" data-toggle="tab">
                                            <i class="fa fa-share mr-1"></i>
                                            Follow
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="general">
                                        <ul class="products-list product-list-in-card">
                                            <li class="item">
                                                <strong><i class="far fa-calendar-alt mr-1"></i> Date</strong>
                                                <div class="text-muted">{{ $date_init }}</div>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                <strong><i class="fas fa-dollar-sign mr-1"></i> Cost</strong>
                                                <div class="text-muted">{{ number_format($maintenance->cost, 2) }}</div>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                <strong><i class="fas fa-user-cog mr-1"></i> User</strong>
                                                <div class="text-muted">{{ $maintenance->user_name }}</div>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                <strong><i class="fas fa-binoculars mr-1"></i> Observations</strong>
                                                <div class="text-muted">{{ $maintenance->observation_init }}</div>
                                            </li>
                                            <!-- /.item -->
                                        </ul>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="status">
                                        <ul class="products-list product-list-in-card">
                                            <li class="item">
                                                <strong><i class="far fa-circle mr-1"></i> Status</strong>
                                                <div class="text-muted">{{ $maintenance->status }}</div>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                <strong><i class="far fa-calendar-alt mr-1"></i> Date</strong>
                                                <div class="text-muted">{{ $date_status }}</div>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                <strong><i class="fas fa-binoculars mr-1"></i> Observations</strong>
                                                <div class="text-muted">
                                                    {{ $observation_status }}
                                                </div>
                                            </li>
                                            <!-- /.item -->
                                        </ul>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="follow">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                            @php
                                                $status = 0;
                                            @endphp
                                            @foreach ($maintenance->follows as $item)
                                                @php
                                                    $status = 1;
                                                @endphp
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                    <span class="bg-success">
                                                        {{ date('d M. Y', strtotime($item->created_at)) }}
                                                    </span>
                                                </div>
                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-cog fa-spin bg-primary"></i>
                                                    <div class="timeline-item">
                                                        <span class="time">
                                                            <i class="far fa-clock"></i>
                                                            {{ date('H:i', strtotime($item->created_at)) }}</span>
                                                        <h3 class="timeline-header bg-navy">{{ $item->user->name }}
                                                        </h3>
                                                        <div class="timeline-body">{{ $item->observation }}</div>
                                                        <div class="timeline-footer">
                                                            <div class="float-right">
                                                                <span
                                                                    class="badge badge-warning">{{ $item->status }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END timeline item -->
                                            @endforeach
                                            @if ($status == 0)
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                    <span class="bg-success">
                                                        {{ date('d M. Y', strtotime(Carbon\Carbon::now())) }}
                                                    </span>
                                                </div>
                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-cog fa-spin bg-primary"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i>
                                                            {{ date('H:i', strtotime(Carbon\Carbon::now())) }}</span>
                                                        <h3 class="timeline-header bg-navy">Unnamed</h3>
                                                        <div class="timeline-body">Not Found</div>
                                                        <div class="timeline-footer">
                                                            <div class="float-right">
                                                                <span class="badge badge-danger">Not apply</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END timeline item -->
                                            @endif
                                            <div>
                                                <i class="far fa-clock bg-gray"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</x-master>
