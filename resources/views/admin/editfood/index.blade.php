@extends('admin.layout.app')
@section('title', 'Food Data')
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
                <a href="{{ Route('food.create') }}" class="btn btn-primary mb-3">Add Food</a>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">food data </h5>
                            {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> --}}

                            <form method="GET" action="{{ route('food.index') }}" class="mb-3 d-flex gap-2">

                                <!-- Category Filter -->
                                <select name="category" class="form-control">
                                    <option value="">All Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <!-- Price Filter -->
                                <input type="number" name="min_price" placeholder="Min Price" class="form-control">
                                <input type="number" name="max_price" placeholder="Max Price" class="form-control">

                                <button type="submit" class="btn btn-primary">Filter</button>

                            </form>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>heading</th>
                                        <th>description</th>
                                        <th>price</th>
                                        <th>discount</th>
                                        <th>category</th>
                                        <th>status</th>
                                        <th>image</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foods as $food)
                                        <tr>
                                            <td>{{ $food->id }}</td>
                                            <td>{{ $food->head }}</td>
                                            <td>{{ $food->desc }}</td>
                                            <td>{{ $food->price }}</td>
                                            <td>{{ $food->discount_price }}</td>
                                            <td>{{ $food->category }}</td>
                                            <td>{{ $food->status ? 'Available' : 'Hidden' }}</td>
                                            <td><img src="{{ asset('storage/' . $food->image) }}" alt=""
                                                    width="50px"></td>
                                            <td><a href="{{ route('food.edit', $food->id) }}" class="btn btn-primary">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <a href="{{ route('food.destroy', $food->id) }}" class="btn btn-danger">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
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
