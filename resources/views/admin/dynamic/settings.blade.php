@extends('admin.layout.app')
@section('title','Settings')
@section('content')
<main id="main" class="main">
    <h1>Website Settings</h1>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card"><div class="card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="row g-3 mt-2">
            @csrf
            <div class="col-md-6"><input type="text" name="site_name" value="{{ $setting->site_name ?? '' }}" class="form-control" placeholder="Site Name"></div>
            <div class="col-md-3"><input type="file" name="logo" class="form-control"></div>
            <div class="col-md-3"><input type="file" name="favicon" class="form-control"></div>
            <div class="col-md-12"><textarea name="footer_text" class="form-control" placeholder="Footer Text">{{ $setting->footer_text ?? '' }}</textarea></div>
            <div class="col-md-4"><input type="text" name="address" value="{{ $setting->address ?? '' }}" class="form-control" placeholder="Address"></div>
            <div class="col-md-4"><input type="text" name="phone" value="{{ $setting->phone ?? '' }}" class="form-control" placeholder="Phone"></div>
            <div class="col-md-4"><input type="email" name="email" value="{{ $setting->email ?? '' }}" class="form-control" placeholder="Email"></div>
            <div class="col-md-4"><input type="text" name="facebook" value="{{ $setting->facebook ?? '' }}" class="form-control" placeholder="Facebook"></div>
            <div class="col-md-4"><input type="text" name="twitter" value="{{ $setting->twitter ?? '' }}" class="form-control" placeholder="Twitter"></div>
            <div class="col-md-4"><input type="text" name="instagram" value="{{ $setting->instagram ?? '' }}" class="form-control" placeholder="Instagram"></div>
            <div class="col-md-4"><input type="text" name="linkedin" value="{{ $setting->linkedin ?? '' }}" class="form-control" placeholder="LinkedIn"></div>
            <div class="col-md-4"><input type="text" name="youtube" value="{{ $setting->youtube ?? '' }}" class="form-control" placeholder="Youtube"></div>
            <div class="col-md-12"><button class="btn btn-primary">Update Settings</button></div>
        </form>
    </div></div>
</main>
@endsection
