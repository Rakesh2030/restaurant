@extends('admin.layout.app')
@section('title','Customers')
@section('content')
<main id="main" class="main">
    <h1>Customers</h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_email }}</td>
                            <td>{{ $customer->customer_phone }}</td>
                            <td>{{ $customer->customer_address }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
