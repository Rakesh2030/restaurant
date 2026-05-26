<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>about page </h3>
    <form action="{{Route('aboutus.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="heading" id="heading" placeholder="heading">
        <input type="text" name="description" id="description" placeholder="description">
        <input type="text" name="YOE" id="YOE" placeholder="YOE year of experience">
        <input type="text" name="PMC" id="PMC" placeholder="PMC popular master chef">
        <input type="file" name="image1" id="image1" placeholder="image1">
        <input type="file" name="image2" id="image2" placeholder="image2">
        <input type="file" name="image3" id="image3" placeholder="image3">
        <input type="file" name="image4" id="image4" placeholder="image4">
        <button>submit</button>
    </form>

</body>

</html>
