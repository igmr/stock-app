@php
    $menu = $data['menu'];
    $maintenance = $data['maintenance'];
@endphp
<x-master>
    @slot('menu', $menu)

    <form action="{{ route('app.maintenance.follow_action', $maintenance) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle shadow-lg">
                    <!-- Left navbar links -->
                    <div class="navbar-nav">
                        <div class="nav-item">
                            <i class="fas fa-tools mr-1"></i>
                            New follow maintenance
                        </div>
                    </div>
                    <!-- Right navbar links -->
                    <div class="navbar-nav ml-auto">
                        <div class="nav-item">
                            <a href="{{ route('app.printer.index') }}" class="btn btn-outline-danger btn-sm mr-2">
                                <i class="fas fa-ban"></i> Cancel
                            </a>
                        </div>
                        <div class="nav-item">
                            <button type="submit" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-plus"></i> Save
                            </button>
                        </div>
                    </div>
                </nav>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card shadow-lg">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><i class="fas fa-bars mr-1"></i> General</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="observation">Observations</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-binoculars"></i></span>
                                        </div>
                                        <textarea id="observation" class="form-control @error('observation') is-invalid @enderror" rows="3"
                                            name="observation" placeholder="Maintenance observation">{{ old('observation') }}</textarea>
                                    </div>
                                    <!-- /.input group -->
                                    @error('observation')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.col-12-->
                        </div>
                        <!-- /.row-->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
    </form>
</x-master>
