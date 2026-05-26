@extends('frontend.pages.layout.app')
@section('title','Checkout')
@section('content')

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="mb-4">Checkout</h1>
        <form method="POST" action="{{ route('order.place') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="customer_name" class="form-control" placeholder="Your Name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="customer_email" class="form-control" placeholder="Your Email" value="{{ old('customer_email', auth()->user()->email ?? '') }}">
                </div>
                <div class="col-md-6">
                    <input type="text" name="customer_phone" class="form-control" placeholder="Phone" value="{{ old('customer_phone', auth()->user()->phone ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="customer_address" class="form-control" placeholder="Address" required>
                </div>
                <div class="col-12">
                    <textarea name="note" class="form-control" placeholder="Order note"></textarea>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary py-3 px-5">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
