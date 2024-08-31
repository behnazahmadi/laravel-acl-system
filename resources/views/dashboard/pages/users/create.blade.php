@extends("dashboard.layout.body")

@section("styles")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
@section("content")
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Create New User</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">Create User</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-12">
                        <form class="card" method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-0">Create User</h4>
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
                                            <label class="form-label">Name</label>
                                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">Assign Roles</label>
                                        <select class="form-control select2" name="roles[]" multiple="multiple" required>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select roles",
                allowClear: true
            });
        });
    </script>

@endsection
