@extends('frontend.pages.layout.app')
@section('title','Cart')
@section('content')

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="mb-4">Your Cart</h1>
        @php $total = 0; @endphp

        @if(count($cart) > 0)
            <table class="table table-bordered">
                <tr>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                @foreach($cart as $id => $item)
                    @php $rowTotal = $item['price'] * $item['quantity']; $total += $rowTotal; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>₹{{ $item['price'] }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.update', $id) }}" class="d-flex">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control me-2" style="width:90px;">
                                <button class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>₹{{ $rowTotal }}</td>
                        <td><a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                @endforeach
            </table>
            <h3 class="text-end">Total: ₹{{ $total }}</h3>
            <div class="text-end">
                <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
            </div>
        @else
            <p>Your cart is empty.</p>
            <a href="{{ route('frontend.pages.menu') }}" class="btn btn-primary">Go To Menu</a>
        @endif
    </div>
</div>

@endsection
