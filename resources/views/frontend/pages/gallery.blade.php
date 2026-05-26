@extends('frontend.pages.layout.app')
@section('title','Gallery')
@section('content')

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            @foreach($galleries as $gallery)
                <div class="col-md-4">
                    <img src="{{ asset('storage/'.$gallery->image) }}" class="img-fluid rounded" alt="">
                    <h5 class="mt-2">{{ $gallery->title }}</h5>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
