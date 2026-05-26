@extends('admin.layout.app')
@section('title','Admin Dashboard')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.page') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    @php
        $cards = [
            ['title' => 'Total Orders', 'value' => $totalOrders, 'icon' => 'bi-cart-check', 'color' => 'primary', 'badge' => 'All Orders'],
            ['title' => 'Total Customers', 'value' => $totalCustomers, 'icon' => 'bi-people', 'color' => 'success', 'badge' => 'Customers'],
            ['title' => 'Food Items', 'value' => $totalFoodItems, 'icon' => 'bi-egg-fried', 'color' => 'warning', 'badge' => 'Menu'],
            ['title' => 'Categories', 'value' => $totalCategories, 'icon' => 'bi-tags', 'color' => 'info', 'badge' => 'Food Types'],
            ['title' => 'Reservations', 'value' => $totalReservations, 'icon' => 'bi-calendar2-check', 'color' => 'secondary', 'badge' => 'Bookings'],
            ['title' => 'Pending Orders', 'value' => $pendingOrders, 'icon' => 'bi-hourglass-split', 'color' => 'danger', 'badge' => 'Need Action'],
            ['title' => 'Completed Orders', 'value' => $completedOrders, 'icon' => 'bi-check-circle', 'color' => 'success', 'badge' => 'Delivered'],
            ['title' => 'Total Revenue', 'value' => 'Rs. ' . number_format($totalRevenue, 2), 'icon' => 'bi-cash-stack', 'color' => 'primary', 'badge' => 'Sales'],
        ];

        $dashboardBadgeClass = function ($status) {
            $status = strtolower($status ?? 'pending');

            if (in_array($status, ['delivered', 'completed', 'confirmed', 'paid'])) {
                return 'success';
            }

            if (in_array($status, ['pending', 'preparing'])) {
                return 'warning';
            }

            if (in_array($status, ['cancelled', 'rejected', 'failed'])) {
                return 'danger';
            }

            return 'primary';
        };
    @endphp

    <section class="section dashboard">
        <div class="row g-3">
            @foreach($cards as $card)
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card info-card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title mb-0">{{ $card['title'] }}</h5>
                                <span class="badge bg-{{ $card['color'] }}-subtle text-{{ $card['color'] }}">{{ $card['badge'] }}</span>
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <div class="rounded-circle bg-{{ $card['color'] }} bg-opacity-10 text-{{ $card['color'] }} d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                                    <i class="bi {{ $card['icon'] }} fs-4"></i>
                                </div>
                                <div class="ps-3">
                                    <h4 class="mb-0 fw-bold">{{ $card['value'] }}</h4>
                                    <span class="text-muted small">Real database data</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-3 mt-1">
            <div class="col-lg-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Orders <span>| This Year</span></h5>
                        <canvas id="ordersChart" style="min-height: 280px;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">Revenue Overview <span>| This Year</span></h5>
                        <canvas id="revenueChart" style="min-height: 280px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <h5 class="card-title mb-0">Recent Orders</h5>
                            <a href="{{ route('admin.orders') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i> View All
                            </a>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Total Amount</th>
                                        <th>Payment Status</th>
                                        <th>Order Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>Rs. {{ number_format($order->total, 2) }}</td>
                                            <td><span class="badge bg-info">Cash On Delivery</span></td>
                                            <td>
                                                <span class="badge bg-{{ $dashboardBadgeClass($order->status) }}">
                                                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.orders.details', $order->id) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">No recent orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">Recent Reservations</h5>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Guests</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentReservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->name }}</td>
                                            <td>{{ $reservation->phone }}</td>
                                            <td>{{ $reservation->guests ?? $reservation->people }}</td>
                                            <td>{{ $reservation->date ?? $reservation->datetime }}</td>
                                            <td>{{ $reservation->time ?? '-' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $dashboardBadgeClass($reservation->status) }}">
                                                    {{ ucfirst($reservation->status ?? 'pending') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">No recent reservations found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">Low Stock Alert</h5>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Food Name</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lowStockFoods as $food)
                                        <tr>
                                            <td>{{ $food->head }}</td>
                                            <td>{{ $food->stock }}</td>
                                            <td><span class="badge bg-danger">Low Stock</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">No low stock items found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-12">
                <div class="card top-selling shadow-sm border-0">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Top Selling Foods</h5>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Food</th>
                                        <th>Name</th>
                                        <th>Total Orders</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topSellingFoods as $food)
                                        <tr>
                                            <td>
                                                @if($food->image)
                                                    <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->food_name }}" style="width: 58px; height: 58px; object-fit: cover; border-radius: 8px;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 58px; height: 58px; border-radius: 8px;">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="fw-semibold">{{ $food->food_name }}</td>
                                            <td><span class="badge bg-success">{{ $food->total_orders }}</span></td>
                                            <td>{{ $food->category ?? 'Uncategorized' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">No ordered food data found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var monthLabels = @json($monthLabels);
        var monthlyOrders = @json($monthlyOrders);
        var monthlyRevenue = @json($monthlyRevenue);

        new Chart(document.getElementById('ordersChart'), {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Orders',
                    data: monthlyOrders,
                    backgroundColor: '#0d6efd'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Revenue',
                    data: monthlyRevenue,
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.12)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>

@endsection
