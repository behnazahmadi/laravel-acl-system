@extends("dashboard.layout.body")

@section("styles")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Edit Blog</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item active">Edit Blog</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-12">
                        <form class="card" method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-0">Edit Blog</h4>
                                <div class="card-options">
                                    <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input class="form-control" type="text" name="title" value="{{ old('title', $blog->title) }}" placeholder="Title" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">File Upload</label>
                                            <input class="form-control" type="file" name="file_path">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-control btn-square" name="status">
                                                <option value="APPROVED" {{ old('status', $blog->status) == 'APPROVED' ? 'selected' : '' }}>Approved</option>
                                                <option value="PENDING" {{ old('status', $blog->status) == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                                <option value="REJECTED" {{ old('status', $blog->status) == 'REJECTED' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">Body</label>
                                            <textarea class="form-control" name="body" rows="5" placeholder="Write Blog Content">{{ old('body', $blog->body) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Tags</label>
                                            <select class="form-control select2" name="tags[]" multiple="multiple" required>
                                                @foreach($allTags as $tag)
                                                    <option value="{{ $tag->name }}" {{ in_array($tag->name, $blogTags) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@section("scripts")
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select tags",
                allowClear: true
            });
        });
    </script>
@endsection
