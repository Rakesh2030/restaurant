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
      @if (session('success'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
        <div class="text-end">
            <a href="{{Route('chef.create')}}" class="btn btn-primary mb-3">Add Chef</a>
            <a href="{{ Route('frontend.home') }}" class="btn btn-primary">Show Chefs on Frontend</a>
            {{-- <a href="{{Route('chef.save')}}" class="btn btn-primary mb-3">Save data </a> --}}
        </div>
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Chef data </h5>
              {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> --}}

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      id
                    </th>
                    <th>name</th>
                    <th>Designation</th>
                    <th>Image</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($chefs as $chef)
                    <tr>
                        <td>{{$chef->id}}</td>
                        <td>{{$chef->name}}</td>
                        <td>{{$chef->designation}}</td>
                        <td>{{$chef->image}}</td>
                        <td>
                          <a href="{{Route('chef.edit',$chef->id)}}">Edit  | </a>
                          <a href="{{Route('chef.destroy',$chef->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
    
@endsection