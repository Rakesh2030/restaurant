@extends('frontend.pages.layout.app')
@section('title','menu page')
@section('content')

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
            <h1 class="mb-5">Choose Your Favorite Food</h1>
        </div>

        <form method="GET" action="{{ route('frontend.pages.menu') }}" class="row g-3 mb-5">
            <div class="col-md-5">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search food">
            </div>
            <div class="col-md-5">
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            @forelse($foods as $food)
                <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 img-fluid rounded" src="{{ $food->image ? asset('storage/'.$food->image) : asset('user/img/menu-1.jpg') }}" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="w-100 d-flex flex-column text-start ps-4">
                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                <a href="{{ route('frontend.food.details', $food->id) }}">{{ $food->head }}</a>
                                <span class="text-primary">
                                    @if($food->discount_price)
                                        <small class="text-muted text-decoration-line-through">₹{{ $food->price }}</small>
                                        ₹{{ $food->discount_price }}
                                    @else
                                        ₹{{ $food->price }}
                                    @endif
                                </span>
                            </h5>
                            <small class="fst-italic">{{ $food->desc }}</small>
                            <form action="{{ route('cart.add', $food->id) }}" method="POST" class="mt-2 add-cart-form">
                                @csrf
                                <button class="btn btn-sm btn-primary">Add To Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No food found.</p>
                </div>
            @endforelse
        </div>

        @if($offers->count() > 0)
            <div class="text-center mt-5">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Offers</h5>
                <h1 class="mb-4">Special Offers</h1>
            </div>
            <div class="row g-4">
                @foreach($offers as $offer)
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            @if($offer->image)
                                <img src="{{ asset('storage/'.$offer->image) }}" class="img-fluid rounded mb-3" alt="">
                            @endif
                            <h5>{{ $offer->title }}</h5>
                            <p>{{ $offer->description }}</p>
                            <strong class="text-primary">{{ $offer->discount_text }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    $('.add-cart-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response.message);
            }
        });
    });
</script>

@endsection
