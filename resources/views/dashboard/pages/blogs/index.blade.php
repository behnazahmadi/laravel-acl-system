@extends("dashboard.layout.body")

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Blog list</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Blog list</li>
                    </ol>
                </div>
                <!-- Create Button -->
                <div class="col-sm-6 text-end">
                    @can('create posts')
                        <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                            Create New Blog
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
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; ?>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td class="font-danger">{{ $item->title }}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            @can('delete posts')
                                                <form action="{{ route('blogs.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-xs" type="submit" data-original-title="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                            @can('update posts')
                                                <a href="{{ route('blogs.edit', $item->id) }}" class="btn btn-primary btn-xs" data-original-title="btn btn-danger btn-xs" title="Edit">Edit</a>
                                            @endcan
                                                @can('read posts')
                                                    <a href="{{ route('blogs.show', $item->id) }}" class="btn btn-info btn-xs" title="View">Show</a>
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
