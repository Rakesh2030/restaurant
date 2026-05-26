@extends('admin.layout.app')
@section('title','Gallery')
@section('content')
<main id="main" class="main">
    <h1>Gallery</h1>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card"><div class="card-body">
        <h5 class="card-title">Add Gallery Image</h5>
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-5"><input type="text" name="title" class="form-control" placeholder="Title"></div>
            <div class="col-md-5"><input type="file" name="image" class="form-control" required></div>
            <div class="col-md-1"><label><input type="checkbox" name="status" checked> Active</label></div>
            <div class="col-md-1"><button class="btn btn-primary">Save</button></div>
        </form>
    </div></div>
    <div class="row">
        @foreach($galleries as $gallery)
            <div class="col-md-3">
                <div class="card"><div class="card-body">
                    <img src="{{ asset('storage/'.$gallery->image) }}" class="img-fluid mt-3">
                    <h5>{{ $gallery->title }}</h5>
                    <a href="{{ route('admin.gallery.delete', $gallery->id) }}" class="btn btn-danger btn-sm">Delete</a>
                </div></div>
            </div>
        @endforeach
    </div>
</main>
@endsection
