<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>data </h3>
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>heading</td>
                <td>desc</td>
                <td>yoe</td>
                <td>pmc</td>
                <td>image1</td>
                <td>image2</td>
                <td>image3</td>
                <td>image4</td>
                <td>edit</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($about as $abt)
                <tr>
                    <td>{{$abt->id}}</td>
                    <td>{{$abt->heading}}</td>
                    <td>{{$abt->description}}</td>
                    <td>{{$abt->YOE}}</td>
                    <td>{{$abt->PMC}}</td>
                    <td>{{$abt->image1}}</td>
                    <td>{{$abt->image2}}</td>
                    <td>{{$abt->image3}}</td>
                    <td>{{$abt->image4}}</td>
                    <td>
                        <a href="{{Route('aboutus.edit',$abt->id)}}"> edit </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
