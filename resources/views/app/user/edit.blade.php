@php
    $menu = $data['menu'];
    $user = $data['user'];
@endphp
<x-master>
    @slot('menu', $menu)

    <form action="{{ route('app.user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <nav class="navbar navbar-expand navbar-light bg-navy navbar-subtitle shadow-lg">
                    <!-- Left navbar links -->
                    <div class="navbar-nav">
                        <div class="nav-item">
                            <i class="fas fa-users mr-1"></i>
                            Edit users
                        </div>
                    </div>
                    <!-- Right navbar links -->
                    <div class="navbar-nav ml-auto">
                        <div class="nav-item">
                            <a href="{{ route('app.user.index') }}" class="btn btn-outline-danger btn-sm mr-2">
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
                                    <label for="name">name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="John"
                                            value="{{ old('name') ?? $user->name }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('name')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-12-->

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="demo@demo.com"
                                            value="{{ old('email') ?? $user->email }}">
                                    </div>
                                    <!-- /.input group -->
                                    @error('email')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-12-->
                        </div>
                        <!-- /.row-->
                    </div>
                    <!-- /.row-->
                </div>
                <!-- /.card-body -->
            </section>
            <!-- /.content -->
        </div>
    </form>
</x-master>
