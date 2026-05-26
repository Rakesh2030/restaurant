@extends('admin.layout.app')
@section('title', 'Food Create')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Elements</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
          <div class="text-end">
            <a href="{{Route('food.index')}}" class="btn btn-primary mb-3">Back</a>
          </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Food List</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{route('food.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="inputText" class=" col-form-label">Name of food </label>
                                        <input type="text" class="form-control" name="head">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputText" class=" col-form-label">About food</label>
                                        <input type="text" class="form-control" name="desc">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputText" class=" col-form-label">Price</label>
                                        <input type="number" class="form-control" name="price">
                                    </div>
                                    <div class="col-md-6">
                                        <label class=" col-form-label">Discount Price</label>
                                        <input type="number" class="form-control" name="discount_price">
                                    </div>
                                    <div class="col-md-12">
                                        <label class=" col-form-label">Ingredients</label>
                                        <textarea class="form-control" name="ingredients"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="image" class=" col-form-label">image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="col-md-6 mt-4 ">
                                        <select name="category" id="category" class="form-select">
                                            <option value="">select an option</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-3"><label><input type="checkbox" name="status" checked> Available</label></div>
                                    <div class="col-md-4 mt-3"><label><input type="checkbox" name="featured"> Featured</label></div>
                                    <div class="col-md-4 mt-3"><label><input type="checkbox" name="popular"> Popular</label></div>

                                </div>


                                <div class="row mb-3">
                                    {{-- <label class="col-sm-2 col-form-label">Submit Button</label> --}}
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Add Food</button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>


            </div>
        </section>

        {{-- </main> --}}
        <!-- End #main -->

    @endsection
