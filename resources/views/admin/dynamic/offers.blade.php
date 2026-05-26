@extends('admin.layout.app')
@section('title','Offers')
@section('content')
<main id="main" class="main">
    <h1>Offers</h1>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card"><div class="card-body">
        <h5 class="card-title">Add Offer</h5>
        <form method="POST" action="{{ route('admin.offers.store') }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-4"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
            <div class="col-md-4"><input type="text" name="discount_text" class="form-control" placeholder="Discount Text"></div>
            <div class="col-md-4"><input type="file" name="image" class="form-control"></div>
            <div class="col-md-10"><textarea name="description" class="form-control" placeholder="Description"></textarea></div>
            <div class="col-md-1"><label><input type="checkbox" name="status" checked> Active</label></div>
            <div class="col-md-1"><button class="btn btn-primary">Save</button></div>
        </form>
    </div></div>
    <div class="card"><div class="card-body">
        <table class="table"><tr><th>Title</th><th>Discount</th><th>Image</th><th>Status</th><th>Action</th></tr>
            @foreach($offers as $offer)
                <tr>
                    <td>{{ $offer->title }}</td><td>{{ $offer->discount_text }}</td>
                    <td>@if($offer->image)<img src="{{ asset('storage/'.$offer->image) }}" width="60">@endif</td>
                    <td>{{ $offer->status ? 'Active' : 'Hidden' }}</td>
                    <td><a href="{{ route('admin.offers.delete', $offer->id) }}" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div></div>
</main>
@endsection
