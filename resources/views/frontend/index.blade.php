@extends('frontend.layout.app')
@section('title','Home')
@section('content')

@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success">{{ session('success') }}</div>
    </div>
@endif

<!-- Categories Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="{{ route('frontend.pages.menu', ['category' => $category->name]) }}" class="text-dark">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                @if($category->image)
                                    <img src="{{ asset('storage/'.$category->image) }}" class="img-fluid rounded mb-3" style="height: 80px; object-fit: cover;" alt="">
                                @else
                                    <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                                @endif
                                <h5>{{ $category->name }}</h5>
                                <p>View all {{ $category->name }} foods.</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Categories End -->

<!-- About Start -->
@if($about)
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="row g-3">
                    @foreach(['image1', 'image2', 'image3', 'image4'] as $image)
                        @if($about->$image)
                        <div class="col-6">
                            <img class="img-fluid rounded w-100 wow zoomIn" src="{{ asset('storage/aboutus/'.$about->$image) }}" alt="">
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                <h1 class="mb-4">{{ $about->heading }}</h1>
                <p class="mb-4">{{ $about->description }}</p>
                <div class="row g-4 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0">{{ $about->YOE }}</h1>
                            <div class="ps-4">
                                <p class="mb-0">Years of</p>
                                <h6 class="text-uppercase mb-0">Experience</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0">{{ $about->PMC }}</h1>
                            <div class="ps-4">
                                <p class="mb-0">Popular</p>
                                <h6 class="text-uppercase mb-0">Master Chefs</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="{{ route('frontend.pages.about') }}">Read More</a>
            </div>
        </div>
    </div>
</div>
@endif
<!-- About End -->

<!-- Menu Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
            <h1 class="mb-5">Popular Foods</h1>
        </div>
        <div class="row g-4">
            @foreach(($popularFoods->count() ? $popularFoods : $foods->take(6)) as $food)
                <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 img-fluid rounded" src="{{ $food->image ? asset('storage/'.$food->image) : asset('user/img/menu-1.jpg') }}" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="w-100 d-flex flex-column text-start ps-4">
                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                <a href="{{ route('frontend.food.details', $food->id) }}">{{ $food->head }}</a>
                                <span class="text-primary">₹{{ $food->discount_price ?: $food->price }}</span>
                            </h5>
                            <small class="fst-italic">{{ $food->desc }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Menu End -->

<!-- Offers Start -->
@if($offers->count() > 0)
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Offers</h5>
            <h1 class="mb-5">Special Deals</h1>
        </div>
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
@endif
<!-- Offers End -->

<!-- Reservation Start -->
<div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-md-6">
            <div class="video"></div>
        </div>
        <div class="col-md-6 bg-dark d-flex align-items-center">
            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                <h1 class="text-white mb-4">Book A Table Online</h1>
                <form action="{{ route('reservation.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6"><input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" placeholder="Your Name" required></div>
                        <div class="col-md-6"><input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="Your Email" required></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="Phone" required></div>
                        <div class="col-md-6"><input type="date" class="form-control" name="date" value="{{ old('date') }}" required></div>
                        <div class="col-md-6"><input type="time" class="form-control" name="time" value="{{ old('time') }}" required></div>
                        <div class="col-md-6">
                            <select class="form-select" name="guests" required>
                                <option value="">Select People</option>
                                <option value="1" {{ old('guests') == 1 ? 'selected' : '' }}>People 1</option>
                                <option value="2" {{ old('guests') == 2 ? 'selected' : '' }}>People 2</option>
                                <option value="3" {{ old('guests') == 3 ? 'selected' : '' }}>People 3</option>
                                <option value="4" {{ old('guests') == 4 ? 'selected' : '' }}>People 4</option>
                                <option value="5" {{ old('guests') == 5 ? 'selected' : '' }}>People 5</option>
                                <option value="6" {{ old('guests') == 6 ? 'selected' : '' }}>People 6</option>
                            </select>
                        </div>
                        <div class="col-12"><textarea class="form-control" placeholder="Special Request" name="message">{{ old('message') }}</textarea></div>
                        <div class="col-12"><button class="btn btn-primary w-100 py-3" type="submit">Book Now</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Reservation End -->

<!-- Team Start -->
<div class="container-xxl pt-5 pb-3">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Team Members</h5>
            <h1 class="mb-5">Our Master Chefs</h1>
        </div>
        <div class="row g-4">
            @foreach($chefs as $chef)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <div class="rounded-circle overflow-hidden m-4">
                            <img class="img-fluid" src="{{ $chef->image ? asset('storage/chefs/' . $chef->image) : asset('user/img/team-1.jpg') }}" alt="">
                        </div>
                        <h5 class="mb-0">{{ $chef->name }}</h5>
                        <small>{{ $chef->designation }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Team End -->

<!-- Testimonial Start -->
@if($testimonials->count() > 0)
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Testimonial</h5>
            <h1 class="mb-5">Our Clients Say</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            @foreach($testimonials as $testimonial)
                <div class="testimonial-item bg-transparent border rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                    <p>{{ $testimonial->message }}</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ $testimonial->image ? asset('storage/'.$testimonial->image) : asset('user/img/testimonial-1.jpg') }}" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">{{ $testimonial->name }}</h5>
                            <small>{{ $testimonial->profession }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- Testimonial End -->

@endsection
