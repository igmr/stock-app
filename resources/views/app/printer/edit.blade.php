@php
    $menu = $data['menu'];
    $brands = $data['brands'];
    $printer = $data['printer'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            //Initialize Select2 Elements
            $('.select2').select2()
        </script>
    @endslot

    <form action="{{ route('app.printer.update', $printer) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle shadow-lg">
                    <!-- Left navbar links -->
                    <div class="navbar-nav">
                        <div class="nav-item">
                            <i class="fas fa-print mr-1"></i>
                            Edit printer
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
                                    <label for="brand">Brand</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-qq"></i></span>
                                        </div>
                                        <select class="form-control select2" name="brand" id="brand">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ $printer->brand_id == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.input group -->
                                    @error('brand')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-12-->
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="serial">Serial</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('serial') is-invalid @enderror"
                                            name="serial" id="serial" placeholder="A1B2C3D4"
                                            value="{{ old('serial') ?? $printer->serial }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('serial')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-6-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('model') is-invalid @enderror"
                                            name="model" id="model" placeholder="ABC-1234"
                                            value="{{ old('model') ?? $printer->model }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('model')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-6-->
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-print"></i></span>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            name="description" id="description" placeholder="Lexmark 417"
                                            value="{{ old('description') ?? $printer->description }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('description')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-6-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cost">Cost</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('cost') is-invalid @enderror"
                                            name="cost" id="cost" placeholder="1000.00"
                                            value="{{ old('cost') ?? $printer->cost }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('cost')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-6-->
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <textarea id="location" class="form-control @error('location') is-invalid @enderror" rows="3" name="location"
                                            placeholder="Department IT">{{ old('location') ?? $printer->location }}</textarea>
                                    </div>
                                    <!-- /.input group -->
                                    @error('location')
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
