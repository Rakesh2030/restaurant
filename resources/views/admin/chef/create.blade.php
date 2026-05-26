@extends('admin.layout.app')
@section('title','chef page')
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
              <h5 class="card-title">Add Chef</h5>

              <!-- Horizontal Form -->
              <form action="{{Route('chef.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Name of Chef</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Designation</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="designation"  name="designation">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="image" class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="image"  name="image">
                  </div>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Back</button>
                </div>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

         

        </div>

        
    </section>

  </main>
@endsection