@extends('frontend.pages.layout.app')
@section('title','Offers')
@section('content')

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            @foreach($offers as $offer)
                <div class="col-md-4">
                    <div class="border rounded p-3 h-100">
                        @if($offer->image)
                            <img src="{{ asset('storage/'.$offer->image) }}" class="img-fluid rounded mb-3" alt="">
                        @endif
                        <h4>{{ $offer->title }}</h4>
                        <p>{{ $offer->description }}</p>
                        <strong class="text-primary">{{ $offer->discount_text }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
