@extends("dashboard.layout.body")

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Role List</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Roles</li>
                        <li class="breadcrumb-item active">Role List</li>
                    </ol>
                </div>
                <!-- Create Button -->
                <div class="col-sm-6 text-end">
{{--                    @can('access roles')--}}
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                            Create New Role
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
                        <!-- Optional: Add any additional card header content here -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; ?>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td class="font-danger">{{ $role->name }}</td>
                                        <td>{{ $role->created_at->diffForHumans() }}</td>
                                        <td>{{ $role->updated_at->diffForHumans() }}</td>
{{--                                        @can('access roles')--}}
                                        <td>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-xs" type="submit" title="Delete" onclick="return confirm('Are you sure you want to delete this role?');">
                                                        Delete
                                                    </button>
                                                </form>
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-xs" title="Edit">Edit</a>
                                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-xs" title="View">View</a>
                                        </td>
{{--                                        @endcan--}}
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
            border-bottom: 1px solid #ddd; /* Add a line between rows */
        }
        table.display tr:last-child td {
            border-bottom: none; /* Remove border from the last row */
        }
    </style>
@endsection
