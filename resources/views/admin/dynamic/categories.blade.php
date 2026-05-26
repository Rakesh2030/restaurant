@extends('admin.layout.app')
@section('title','Categories')
@section('content')
<main id="main" class="main">
    <h1>Categories</h1>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card"><div class="card-body">
        <h5 class="card-title">Add Category</h5>
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-4"><input type="text" name="name" class="form-control" placeholder="Category Name" required></div>
            <div class="col-md-4"><input type="file" name="image" class="form-control"></div>
            <div class="col-md-2"><label><input type="checkbox" name="status" checked> Active</label></div>
            <div class="col-md-2"><button class="btn btn-primary">Save</button></div>
        </form>
    </div></div>
    <div class="card"><div class="card-body">
        <table class="table">
            <tr><th>Name</th><th>Image</th><th>Status</th><th>Action</th></tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>@if($category->image)<img src="{{ asset('storage/'.$category->image) }}" width="60">@endif</td>
                    <td>{{ $category->status ? 'Active' : 'Hidden' }}</td>
                    <td><a href="{{ route('admin.categories.delete', $category->id) }}" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div></div>
</main>
@endsection
