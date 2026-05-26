@extends('admin.layout.app')
@section('title','Testimonials')
@section('content')
<main id="main" class="main">
    <h1>Testimonials</h1>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card"><div class="card-body">
        <h5 class="card-title">Add Testimonial</h5>
        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-4"><input type="text" name="name" class="form-control" placeholder="Client Name" required></div>
            <div class="col-md-4"><input type="text" name="profession" class="form-control" placeholder="Profession"></div>
            <div class="col-md-4"><input type="file" name="image" class="form-control"></div>
            <div class="col-md-10"><textarea name="message" class="form-control" placeholder="Message" required></textarea></div>
            <div class="col-md-1"><label><input type="checkbox" name="status" checked> Active</label></div>
            <div class="col-md-1"><button class="btn btn-primary">Save</button></div>
        </form>
    </div></div>
    <div class="card"><div class="card-body">
        <table class="table"><tr><th>Name</th><th>Message</th><th>Status</th><th>Action</th></tr>
            @foreach($testimonials as $testimonial)
                <tr>
                    <td>{{ $testimonial->name }}</td><td>{{ $testimonial->message }}</td>
                    <td>{{ $testimonial->status ? 'Active' : 'Hidden' }}</td>
                    <td><a href="{{ route('admin.testimonials.delete', $testimonial->id) }}" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div></div>
</main>
@endsection
