@extends('admin.layout.app')
@section('title','Orders')
@section('content')
<main id="main" class="main">
    <h1>Orders</h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>Rs. {{ $order->total }}</td>
                            <td><span class="badge bg-primary">{{ ucwords(str_replace('_', ' ', $order->status)) }}</span></td>
                            <td><a href="{{ route('admin.orders.details', $order->id) }}" class="btn btn-primary btn-sm">View</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
