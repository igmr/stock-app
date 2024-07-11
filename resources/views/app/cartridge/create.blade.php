@php
    $menu = $data['menu'];
    $printers = $data['printers'];
    $brands = $data['brands'];
    $colors = $data['colors'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            //Initialize Select2 Elements
            $('.select2').select2()
        </script>
    @endslot

    <form action="{{ route('app.cartridge.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle shadow-lg">
                    <!-- Left navbar links -->
                    <div class="navbar-nav">
                        <div class="nav-item">
                            <i class="fas fa-cubes mr-1"></i>
                            New cartridge
                        </div>
                    </div>
                    <!-- Right navbar links -->
                    <div class="navbar-nav ml-auto">
                        <div class="nav-item">
                            <a href="{{ route('app.cartridge.index') }}" class="btn btn-outline-danger btn-sm mr-2">
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
                                    <label for="printer">Printer</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-print"></i></span>
                                        </div>
                                        <select class="form-control select2" name="printer" id="printer">
                                            @foreach ($printers as $printer)
                                                <option value="{{ $printer->id }}"
                                                    {{ old('printer') == $printer->id ? 'selected' : '' }}>
                                                    {{ $printer->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.input group -->
                                    @error('printer')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-12-->
                        </div>
                        <!-- /.row-->

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            name="description" id="description" placeholder="ABC-123-DEF"
                                            value="{{ old('description') }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('description')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-12 -->
                        </div>
                        <!-- /.row-->

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('model') is-invalid @enderror"
                                            name="model" id="model" placeholder="DR876A"
                                            value="{{ old('model') }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('model')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-6-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tint"></i></span>
                                        </div>
                                        <select class="form-control select2" name="color" id="color">
                                            @foreach ($colors as $color)
                                                <option value="{{ $color }}"
                                                    {{ old('color') == $color ? 'selected' : '' }}>
                                                    {{ $color }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.input group -->
                                    @error('color')
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
                                    <label for="brand">Brand</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-qq"></i></span>
                                        </div>
                                        <select class="form-control select2" name="brand" id="brand">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ old('brand') == $brand->id ? 'selected' : '' }}>
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
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
    </form>
</x-master>
