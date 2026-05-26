@extends('frontend.pages.layout.app')
@section('title', $food->head)
@section('content')

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6">
                <img src="{{ $food->image ? asset('storage/'.$food->image) : asset('user/img/menu-1.jpg') }}" class="img-fluid rounded" alt="">
            </div>
            <div class="col-md-6">
                <h1>{{ $food->head }}</h1>
                <p>{{ $food->desc }}</p>
                <p><strong>Ingredients:</strong> {{ $food->ingredients ?? 'Not added yet' }}</p>
                <h3 class="text-primary">
                    @if($food->discount_price)
                        <small class="text-muted text-decoration-line-through">₹{{ $food->price }}</small>
                        ₹{{ $food->discount_price }}
                    @else
                        ₹{{ $food->price }}
                    @endif
                </h3>
                <form action="{{ route('cart.add', $food->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary py-3 px-5 mt-3">Add To Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
