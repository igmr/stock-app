@php
    $menu = $data['menu'];
    $cartridge = $data['cartridge'];
    $types = $data['types'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            //Initialize Select2 Elements
            $('.select2').select2()
        </script>
    @endslot

    <form action="{{ route('app.stock.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle">
                    <!-- Left navbar links -->
                    <div class="navbar-nav">
                        <div class="nav-item">
                            <i class="fas fa-check-circle mr-1"></i>
                            New stock
                        </div>
                    </div>
                    <!-- Right navbar links -->
                    <div class="navbar-nav ml-auto">
                        <div class="nav-item">
                            <a href="{{ route('app.stock.index') }}" class="btn btn-outline-danger btn-sm mr-2">
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
                <div class="card">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><i class="fas fa-bars mr-1"></i> General</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="cartridge">Cartridge</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-print"></i></span>
                                        </div>
                                        <select class="form-control select2" name="cartridge" id="cartridge">
                                            @foreach ($cartridge as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('cartridge') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.input group -->
                                    @error('cartridge')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fas fa-sort-numeric-up-alt"></i></span>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                            id="quantity" placeholder="1" value="{{ old('quantity') }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('quantity')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-funnel-dollar"></i></span>
                                        </div>
                                        <select class="form-control select2" name="type" id="type">
                                            @foreach ($types as $type)
                                                <option value="{{ $type['id'] }}"
                                                    {{ old('type') == $type['id'] ? 'selected' : '' }}>
                                                    {{ $type['description'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.input group -->
                                    @error('type')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cost">Cost</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('cost') is-invalid @enderror"
                                            name="cost" id="cost" placeholder="1000.00"
                                            value="{{ old('cost') }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('cost')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="observation">Observations</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-binoculars"></i></span>
                                        </div>
                                        <textarea id="observation" class="form-control @error('observation') is-invalid @enderror" rows="3" name="observation"
                                            placeholder="Cartridge observations">{{ old('observation') }}</textarea>
                                    </div>
                                    <!-- /.input group -->
                                    @error('observation')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.col-12-->
                        </div>
                        <!-- /.form group -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
    </form>
</x-master>
