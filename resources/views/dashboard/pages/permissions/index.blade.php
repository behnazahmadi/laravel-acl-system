@extends("dashboard.layout.body")

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Permission List</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Management</li>
                        <li class="breadcrumb-item active">Permission List</li>
                    </ol>
                </div>
                <!-- Create Button -->
                <div class="col-sm-6 text-end">
{{--                    @can('create permissions')--}}
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                            Create New Permission
                        </a>
{{--                    @endcan--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; ?>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td class="font-danger">{{ $permission->name }}</td>
                                        <td>{{ $permission->created_at->diffForHumans() }}</td>
                                        <td>{{ $permission->updated_at->diffForHumans() }}</td>
                                        <td>
{{--                                            @can('delete permissions')--}}
                                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-xs" type="submit" title="Delete" onclick="return confirm('Are you sure you want to delete this permission?');">
                                                        Delete
                                                    </button>
                                                </form>
{{--                                            @endcan--}}
{{--                                            @can('update permissions')--}}
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary btn-xs" title="Edit">Edit</a>
{{--                                            @endcan--}}
{{--                                            @can('read permissions')--}}
                                                <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-info btn-xs" title="View">Show</a>
{{--                                            @endcan--}}
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Custom CSS -->
    <style>
        table.display {
            border-collapse: collapse;
            width: 100%;
        }
        table.display td, table.display th {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        table.display tr:last-child td {
            border-bottom: none;
        }
    </style>
@endsection
