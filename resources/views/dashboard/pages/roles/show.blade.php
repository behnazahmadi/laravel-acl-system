@extends("dashboard.layout.body")

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>View Role</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">{{ $role->name }}</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Role List</a>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">{{ $role->name }}</h4>
                            <div class="card-options">
                                <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Role Name</label>
                                        <p>{{ $role->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Permissions</label>
                                        <ul>
                                            @foreach($role->permissions as $permission)
                                                <li>{{ $permission->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
{{--                            @can('update roles')--}}
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
{{--                            @endcan--}}
{{--                            @can('delete roles')--}}
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this role?');">Delete</button>
                                </form>
{{--                            @endcan--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
