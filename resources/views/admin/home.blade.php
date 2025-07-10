@extends('layouts.adminlte')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">{{ __('Dashboard Admin') }}</div>

                <div class="card-body">@if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                
                    @if (session('status') && !$errors->any())
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as Admin!') }}
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Admin Profile Card -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Admin Information</h3>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        <label for="avatar-input" style="cursor: pointer;" title="Click to change photo">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}"
                                 alt="User profile picture">
                        </label>
                        <form action="{{ route('admin.profile.image.upload') }}" method="POST" enctype="multipart/form-data" id="avatar-upload-form" class="d-none">
                            @csrf
                            <input type="file" id="avatar-input" name="avatar" onchange="this.form.submit()">
                        </form>
                    </div>

                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                    <p class="text-muted text-center">Administrator</p>

                    <a href="#adminDetails" class="btn btn-primary btn-block mt-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="adminDetails">
                        <b>View/Hide Details</b>
                    </a>

                    <div class="collapse mt-3" id="adminDetails">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone</b> <a class="float-right">{{ Auth::user()->phone ?? 'Not provided' }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Member Since</b> <a class="float-right">{{ Auth::user()->created_at->format('d M. Y') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
