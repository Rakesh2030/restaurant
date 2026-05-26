@extends('admin.layout.app')
@section('title', 'Food Edit')
@section('content')
<main id="main" class="main">
    <div class="text-end">
        <a href="{{Route('food.index')}}" class="btn btn-primary mb-3">Back</a>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Food</h5>
            <form method="POST" action="{{route('food.update', $food->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="col-form-label">Name of food</label>
                        <input type="text" class="form-control" name="head" value="{{ $food->head }}">
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label">About food</label>
                        <input type="text" class="form-control" name="desc" value="{{ $food->desc }}">
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label">Price</label>
                        <input type="number" class="form-control" name="price" value="{{ $food->price }}">
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price" value="{{ $food->discount_price }}">
                    </div>
                    <div class="col-md-12">
                        <label class="col-form-label">Ingredients</label>
                        <textarea class="form-control" name="ingredients">{{ $food->ingredients }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        @if($food->image)
                            <img src="{{ asset('storage/'.$food->image) }}" width="80" class="mt-2">
                        @endif
                    </div>
                    <div class="col-md-6 mt-4">
                        <select name="category" class="form-select">
                            <option value="">select an option</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ $food->category == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3"><label><input type="checkbox" name="status" {{ $food->status ? 'checked' : '' }}> Available</label></div>
                    <div class="col-md-4 mt-3"><label><input type="checkbox" name="featured" {{ $food->featured ? 'checked' : '' }}> Featured</label></div>
                    <div class="col-md-4 mt-3"><label><input type="checkbox" name="popular" {{ $food->popular ? 'checked' : '' }}> Popular</label></div>
                </div>
                <button type="submit" class="btn btn-primary">Update Food</button>
            </form>
        </div>
    </div>
</main>
@endsection
