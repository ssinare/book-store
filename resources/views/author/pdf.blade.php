<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$author->name}} {{$author->surname}}</title>
<style>
    
        @font-face {
            font-family: 'Roboto Slab';
            src: url({{asset('fonts/RobotoSlab-Regular.ttf')}});
            font-weight: normal;
        }
        @font-face {
            font-family: 'Roboto Slab';
            src: url({{asset('fonts/RobotoSlab-Bold.ttf')}});
            font-weight: bold;
        }
        body {
            font-family: 'Roboto Slab';
        }
        div {
            margin: 7px;
            padding: 7px;
        }
        .master {
            font-size: 18px;
        }
        .about {
            font-size: 11px;
            color: gray;
        }
        .color {
            margin: 12px;
            font-size: 25px;
            text-transform: uppercase;
        }
div {
    margin: 20px;
}
</style>
</head>
<body>
<div style="font-size:35px; "> Author: {{$author->name}} {{$author->surname}}</div>

<div style="font-size:30px; "><img src="{{$author->photo}}" style="width: 200px; height: 200px"></div>
<div style="font-size:22px; "> <b>Books: </b> 
                            <div> {{$author->photo}}
                            @foreach ($author->authorBooks as $book) 
                                   <li> {{$book->title}}, Publish year: {{$book->year}}</li>  
                            <div style="font-size:14px "> Info about the book: {!!$book->about!!}</div>
                            @endforeach            
                            </div> 
</div>


</body>
</html>