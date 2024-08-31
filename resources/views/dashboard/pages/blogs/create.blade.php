@extends("dashboard.layout.body")

@section("styles")
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection

@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Create Blog</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item active">Create Blog</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-12">
                        <form class="card" method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-0">Create Blog</h4>
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
                                            <input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="Title" required>
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
                                            <select class="form-control" name="status">
                                                <option value="APPROVED">--Select--</option>
                                                <option value="APPROVED" {{ old('status') == 'APPROVED' ? 'selected' : '' }}>Approved</option>
                                                <option value="PENDING" {{ old('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                                <option value="REJECTED" {{ old('status') == 'REJECTED' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Tags</label>
                                            <select class="form-control select2" name="tags[]" multiple="multiple" required>
                                                @foreach($allTags as $tag)
                                                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Body</label>
                                            <textarea class="form-control" name="body" rows="5" placeholder="Write Blog Content" required>{{ old('body') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Create</button>
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
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                tags: true, // Enable tagging
                tokenSeparators: [',', ' '], // Allow creating new tags with comma or space
                placeholder: "Select or create tags",
                allowClear: true
            });
        });
    </script>
@endsection
