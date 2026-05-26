@extends('admin.layout.app')
@section('title','address page')
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
              <h5 class="card-title">Edit address/contact details </h5>
                
              <!-- Horizontal Form -->
              <form action="{{Route('contact.store')}}" method="POST">
                @csrf
                <div class="row mb-3">
                  <label for="street" class="col-sm-2 col-form-label">Enter Street details :</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="street" name="street">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="phone" class="col-sm-2 col-form-label">Enter Phone Number :</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="phone"  name="phone">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email" class="col-sm-2 col-form-label">Enter Email id :</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email"  name="email">
                  </div>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

         

        </div>

        
    </section>

  </main>




@endsection