@php
    $menu = $data['menu'];
    $user = $data['user'];
@endphp
<x-master>
    @slot('menu', $menu)

    <form action="{{ route('app.user.change_password_action', $user) }}" method="POST">
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
                            Change password users
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="current_password">Current password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            name="current_password" id="current_password" placeholder="*************">
                                    </div>
                                    <!-- /.input group -->
                                    @error('current_password')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-4-->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password" placeholder="***********************">
                                    </div>
                                    <!-- /.input group -->
                                    @error('password')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-4-->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password_confirmation">Password confirmation</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password_confirmation" id="password_confirmation"
                                            placeholder="***********************">
                                    </div>
                                    <!-- /.input group -->
                                    @error('password')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                                <!-- /.form group -->
                            </div>
                            <!-- /.col-md-4-->
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
