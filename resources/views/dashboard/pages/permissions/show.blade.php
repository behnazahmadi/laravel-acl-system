@extends("dashboard.layout.body")

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>View Permission</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissions</a></li>
                        <li class="breadcrumb-item active">{{ $permission->name }}</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back to Permission List</a>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">{{ $permission->name }}</h4>
                            <div class="card-options">
                                <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Permission Name</label>
                                        <p>{{ $permission->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Roles with this Permission</label>
                                        <ul>
                                            @foreach($permission->roles as $role)
                                                <li>{{ $role->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
{{--                            @can('update permissions')--}}
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary">Edit</a>
{{--                            @endcan--}}
{{--                            @can('delete permissions')--}}
                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this permission?');">Delete</button>
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
ss
