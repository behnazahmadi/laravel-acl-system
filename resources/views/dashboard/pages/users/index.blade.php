@extends("dashboard.layout.body")

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>User List</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">User List</li>
                    </ol>
                </div>
                <!-- Create Button -->
                <div class="col-sm-6 text-end">
                    @can('create users')
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            Create New User
                        </a>
                    @endcan
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
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; ?>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td class="font-danger">{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @foreach($item->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('view users')
                                                <a href="{{ route('users.show', $item->id) }}"
                                                   class="btn btn-info btn-xs" title="View">View</a>
                                            @endcan
                                            @can('edit users')
                                                <a href="{{ route('users.edit', $item->id) }}"
                                                   class="btn btn-primary btn-xs" title="Edit">Edit</a>
                                            @endcan
                                            @can('delete users')
                                                <form action="{{ route('users.destroy', $item->id) }}" method="POST"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-xs" type="submit" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this user?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan

                                            @can('login user')
                                                @if(Auth::id() !== $item->id)
                                                    <form action="{{ route('users.login', $item->id) }}" method="POST"
                                                          style="display: inline;">
                                                        @csrf
                                                        <button class="btn btn-warning btn-xs" type="submit"
                                                                title="Login as User">Login as User
                                                        </button>
                                                    </form>
                                                @endif
                                            @endcan
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
            border-bottom: 1px solid #ddd; /* Add a line between rows */
        }

        table.display tr:last-child td {
            border-bottom: none; /* Remove border from the last row */
        }
    </style>
@endsection
