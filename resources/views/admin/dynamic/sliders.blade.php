@extends('admin.layout.app')
@section('title','Sliders')
@section('content')
<main id="main" class="main">
    <h1>Sliders / Banners</h1>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card"><div class="card-body">
        <h5 class="card-title">Add Slider</h5>
        <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-4"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
            <div class="col-md-4"><input type="text" name="button_text" class="form-control" placeholder="Button Text"></div>
            <div class="col-md-4"><input type="text" name="button_link" class="form-control" placeholder="Button Link"></div>
            <div class="col-md-6"><input type="file" name="image" class="form-control"></div>
            <div class="col-md-4"><textarea name="description" class="form-control" placeholder="Description"></textarea></div>
            <div class="col-md-1"><label><input type="checkbox" name="status" checked> Active</label></div>
            <div class="col-md-1"><button class="btn btn-primary">Save</button></div>
        </form>
    </div></div>
    <div class="card"><div class="card-body">
        <table class="table"><tr><th>Title</th><th>Image</th><th>Status</th><th>Action</th></tr>
            @foreach($sliders as $slider)
                <tr>
                    <td>{{ $slider->title }}</td>
                    <td>@if($slider->image)<img src="{{ asset('storage/'.$slider->image) }}" width="60">@endif</td>
                    <td>{{ $slider->status ? 'Active' : 'Hidden' }}</td>
                    <td><a href="{{ route('admin.sliders.delete', $slider->id) }}" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div></div>
</main>
@endsection
