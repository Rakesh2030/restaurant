@extends('admin.layout.app')
@section('title','Food Data')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="text-end">
            {{-- <a href="{{Route('chef.save')}}" class="btn btn-primary mb-3">Save data </a> --}}
        </div>
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Customer Reservaion Data </h5>
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> --}}

              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      id
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Guests</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{$reservation->id}}</td>
                        <td>{{$reservation->name}}</td>
                        <td>{{$reservation->email}}</td>
                        <td>{{$reservation->phone}}</td>
                        <td>{{$reservation->date ?? $reservation->datetime}}</td>
                        <td>{{$reservation->time}}</td>
                        <td>{{$reservation->guests ?? $reservation->people}}</td>
                        <td>{{$reservation->message}}</td>
                        <td><span class="badge bg-info">{{ ucfirst($reservation->status ?? 'pending') }}</span></td>
                        <td>
                          <a href="{{ route('reservation.status', [$reservation->id, 'confirmed']) }}" class="btn btn-success btn-sm">Confirm</a>
                          <a href="{{ route('reservation.status', [$reservation->id, 'cancelled']) }}" class="btn btn-danger btn-sm">Cancel</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
    
@endsection
