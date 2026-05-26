@extends('admin.layout.app')
@section('title','Order Details')
@section('content')
<main id="main" class="main">
    <h1>Order #{{ $order->id }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Address:</strong> {{ $order->customer_address }}</p>

            <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="d-flex flex-wrap gap-2 mb-3">
                @csrf
                <select name="status" class="form-control" style="max-width: 250px;">
                    @foreach(['pending','confirmed','preparing','out_for_delivery','delivered'] as $status)
                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                            {{ ucwords(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-primary">Update Status</button>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->food_name }}</td>
                            <td>Rs. {{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rs. {{ $item->total }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <h4>Total: Rs. {{ $order->total }}</h4>
        </div>
    </div>
</main>
@endsection
