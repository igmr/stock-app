@php
    $menu = $data['menu'];
    $printers = $data['printers'];
@endphp
<x-master>
    @slot('menu', $menu)
    @slot('customJS')
        <script>
            //Initialize Select2 Elements
            $('.select2').select2()
            // Date
            let _date = `{!! old('date_init') !!}`;
            if (`{!! old('date_init') !!}` == "") {
                _date = new Date();
            }
            $("#date_init")
                .datepicker({
                    language: "es",
                    format: "yyyy-mm-dd",
                    autoclose: true,
                })
                .datepicker("setDate", _date);
        </script>
    @endslot

    <form action="{{ route('app.maintenance.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle shadow-lg">
                    <!-- Left navbar links -->
                    <div class="navbar-nav">
                        <div class="nav-item">
                            <i class="fas fa-tools mr-1"></i>
                            New maintenance
                        </div>
                    </div>
                    <!-- Right navbar links -->
                    <div class="navbar-nav ml-auto">
                        <div class="nav-item">
                            <a href="{{ route('app.maintenance.index') }}" class="btn btn-outline-danger btn-sm mr-2">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date_init">Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('date_init') is-invalid @enderror"
                                            name="date_init" id="date_init" placeholder="2023-12-31"
                                            value="{{ old('date_init') }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('date_init')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-3 -->
                            <div class="col-md-6">
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
                            <!-- /.col-md-12 -->
                            <div class="col-md-3">
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
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-3 -->
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="internal"><i class="fa fa-wrench"></i> Internal</label>
                                <div class="form-group row mx-1">
                                    <div class="form-check mx-2">
                                        <input class="form-check-input" type="radio" name="internal" value="1" {{old('internal')== 1 ? 'checked': ''}}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input" type="radio" name="internal" value="0" {{old('internal')== 0 ? 'checked': ''}}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                @error('internal')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div>
                            <!-- /.col-md-4-->
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="user_name">Provider</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users-cog"></i></span>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('user_name') is-invalid @enderror"
                                            name="user_name" id="user_name" placeholder="John"
                                            value="{{ old('user_name') }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('user_name')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-8 -->
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="observation">Observations</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-binoculars"></i></span>
                                        </div>
                                        <textarea id="observation" class="form-control @error('observation') is-invalid @enderror" rows="3" name="observation"
                                            placeholder="Maintenance observation">{{ old('observation') }}</textarea>
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
