@extends('admin.layout.app')
@section('title', 'address page')
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
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            <h5 class="card-title">Edit address/contact details </h5>

                            <!-- Horizontal Form -->
                            <form action="{{ Route('contact.update', $contact->id) }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="street" class="col-sm-3 col-form-label">Enter Street details :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="street" name="street"
                                            value="{{ $contact->street }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="phone" class="col-sm-3 col-form-label">Enter Phone Number :</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="phone" name="phone"
                                            value="{{ $contact->phone }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-3 col-form-label">Enter Email id :</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $contact->email }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="facebook" class="col-sm-3 col-form-label">Enter Facebook link : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="facebook" name="facebook"
                                            value="{{ $contact->facebook }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="twitter" class="col-sm-3 col-form-label">Enter Twitter link : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="twitter" name="twitter"
                                            value="{{ $contact->twitter }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="instagram" class="col-sm-3 col-form-label">Enter Instagram link : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="instagram" name="instagram"
                                            value="{{ $contact->instagram }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="linkedin" class="col-sm-3 col-form-label">Enter LinkedIn link : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="linkedin" name="linkedin"
                                            value="{{ $contact->linkedin }}">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                                </div>
                            </form><!-- End Horizontal Form -->

                        </div>
                    </div>



                </div>


        </section>

    </main>




@endsection
