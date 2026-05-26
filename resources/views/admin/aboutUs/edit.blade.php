@extends('admin.layout.app')
@section('title', 'about us page')
@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Layouts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Layouts</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-9">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit About Us Section </h5>

                            <!-- Horizontal Form -->
                            <form action="{{ Route('aboutus.update', $about->id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="row mb-3">
                                    <label for="heading" class="col-sm-2 col-form-label">Heading</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="heading" name="heading"
                                            value="{{ $about->heading }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">Designation</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="description" name="description"
                                            value="{{ $about->description }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="YOE" class="col-sm-2 col-form-label">Year Of Experience</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="YOE" name="YOE"
                                            value="{{$about->YOE}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="PMC" class="col-sm-2 col-form-label">popular master chefs </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="PMC" name="PMC"
                                            value="{{$about->PMC}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image1" class="col-sm-2 col-form-label">Image 1</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="image1" name="image1"
                                            value="{{$about->image1}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image2" class="col-sm-2 col-form-label">Image 2</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="image2" name="image2"
                                            value="{{$about->image2}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image3" class="col-sm-2 col-form-label">Image 3</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="image3" name="image3"
                                            value="{{$about->image3}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image4" class="col-sm-2 col-form-label">Image 4</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="image4" name="image4"
                                            value="{{$about->image4}}">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End Horizontal Form -->

                        </div>
                    </div>



                </div>


        </section>

    </main>
@endsection
