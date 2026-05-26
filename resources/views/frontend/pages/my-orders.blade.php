@extends('frontend.pages.layout.app')
@section('title','My Orders')
@section('content')

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="mb-4">My Orders</h1>

        @if($orders->count() > 0)
            @foreach($orders as $order)
                @php
                    $statuses = ['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered'];
                    $currentStep = array_search($order->status, $statuses);
                    if ($currentStep === false) {
                        $currentStep = 0;
                    }
                @endphp

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                            <div>
                                <h5 class="mb-1">Order #{{ $order->id }}</h5>
                                <small>{{ $order->created_at->format('d M Y h:i A') }}</small>
                            </div>
                            <div>
                                <span class="badge bg-primary">{{ ucwords(str_replace('_', ' ', $order->status)) }}</span>
                                <strong class="ms-2">Rs. {{ $order->total }}</strong>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->food_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rs. {{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar" style="width: {{ (($currentStep + 1) / count($statuses)) * 100 }}%"></div>
                        </div>

                        <div class="row text-center small">
                            @foreach($statuses as $index => $status)
                                <div class="col">
                                    <span class="badge {{ $index <= $currentStep ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucwords(str_replace('_', ' ', $status)) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>You have not placed any orders yet.</p>
            <a href="{{ route('frontend.pages.menu') }}" class="btn btn-primary">Order Food</a>
        @endif
    </div>
</div>

@endsection
