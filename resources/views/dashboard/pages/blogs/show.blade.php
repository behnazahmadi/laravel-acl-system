@extends("dashboard.layout.body")

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>View Blog</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item active">{{ $blog->title }}</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Back to Blog List</a>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">{{ $blog->title }}</h4>
                            <div class="card-options">
                                <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <p>{{ $blog->title }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">File</label>
                                        @if($blog->file_path)
                                            <a href="{{Storage::url($blog->file_path) }}" target="_blank">Download File</a>
                                        @else
                                            <p>No file uploaded.</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <p>{{ ucfirst($blog->status) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Content</label>
                                        <p>{{ $blog->body }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            @can('update posts')
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary">Edit</a>
                            @endcan
                            @can('delete posts')
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</button>
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
