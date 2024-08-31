@extends("dashboard.layout.body")

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>View User</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">{{ $user->name }}</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to User List</a>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">{{ $user->name }}</h4>
                            <div class="card-options">
                                <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <p>{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Roles</label>
                                        <p>
                                            @foreach($user->roles as $role)
                                                <span class="badge bg-info">{{ $role->name }}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Created At</label>
                                        <p>{{ $user->created_at->diffForHumans()  }}</p>
                                        <p>{{ $user->created_at }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            @can('update users')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            @endcan
                            @can('delete users')
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
