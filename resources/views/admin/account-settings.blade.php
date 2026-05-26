@extends('layouts.admin')
@section('title','Account Settings')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Account Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.page') }}">Home</a></li>
                <li class="breadcrumb-item active">Account Settings</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Profile</h5>

                        <form method="POST" action="{{ route('account.settings.update') }}" enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Leave blank to keep old password">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Profile Image</label>
                                <input type="file" name="profile_image" class="form-control">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary">Update Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
