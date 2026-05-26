@extends('frontend.layout.app')
@section('title','no title')
@section('content')

<form action="{{route('homehero.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="heading" id="heading" placeholder="heading enter">
    <input type="text" name="description" id="description" placeholder="description enter">
    <input type="file" name="image" id="image" >
    <button type="submit">submit</button>
</form>

@endsection