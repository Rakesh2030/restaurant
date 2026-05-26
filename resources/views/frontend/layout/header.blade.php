<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ $setting && $setting->favicon ? asset('storage/'.$setting->favicon) : asset('user/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('user/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('user/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('user/css/style.css')}}" rel="stylesheet">
    <style>
        .flash-alert {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 2000;
            max-width: 420px;
        }
        @media (max-width: 767px) {
            .flash-alert {
                left: 12px;
                right: 12px;
                max-width: none;
            }
        }
    </style>
</head>

<body>
        
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    @if($setting && $setting->logo)
                        <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo" style="max-height: 55px;">
                    @else
                        <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>{{ $setting->site_name ?? 'Restoran' }}</h1>
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="{{Route('frontend.home')}}" class="nav-item nav-link active">Home</a>
                        <a href="{{Route('frontend.pages.about')}}" class="nav-item nav-link">About</a>
                        <a href="{{Route('frontend.pages.service')}}" class="nav-item nav-link">Service</a>
                        <a href="{{Route('frontend.pages.menu')}}" class="nav-item nav-link">Menu</a>
                        <a href="{{Route('frontend.offers')}}" class="nav-item nav-link">Offers</a>
                        <a href="{{Route('frontend.gallery')}}" class="nav-item nav-link">Gallery</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="{{Route('frontend.pages.booking')}}" class="dropdown-item">Booking</a>
                                <a href="{{Route('frontend.pages.team')}}" class="dropdown-item">Our Team</a>
                                <a href="{{Route('frontend.pages.testimonial')}}" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="{{Route('frontend.pages.contact')}}" class="nav-item nav-link">Contact</a>
                        @auth
                            <a href="{{ route('orders.my') }}" class="nav-item nav-link">My Orders</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ auth()->user()->name }}</a>
                                <div class="dropdown-menu m-0">
                                    <a href="{{ route('account.settings') }}" class="dropdown-item">Account Settings</a>
                                    @if(auth()->user()->role == 'admin')
                                        <a href="{{ route('admin.page') }}" class="dropdown-item">Admin Panel</a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login.form') }}" class="nav-item nav-link">Login</a>
                        @endauth
                    </div>
                    <a href="{{Route('cart.index')}}" class="btn btn-primary py-2 px-4">Cart ({{ count(session('cart', [])) }})</a>
                </div>
            </nav>
            
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    @php $slider = $sliders->first() ?? null; @endphp
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">{{ $slider->title ?? 'Enjoy Our Delicious Meal' }}</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">{{ $slider->description ?? 'Order fresh and tasty food from our restaurant.' }}</p>
                            <a href="{{ $slider->button_link ?? route('frontend.pages.menu') }}" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">{{ $slider->button_text ?? 'Order Now' }}</a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            @if($slider && $slider->image)
                                <img class="img-fluid" src="{{asset('storage/'.$slider->image)}}" alt="">
                            @else
                                <img class="img-fluid" src="{{asset('user/img/hero.png')}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->
