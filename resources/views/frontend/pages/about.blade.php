@extends('frontend.pages.layout.app')
@section('title','about page')
@section('content')

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
            </div>
        </div>
    </div>
</div>
@endif

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

@endsection
