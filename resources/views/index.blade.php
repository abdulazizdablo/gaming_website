
@extends('layouts.app');

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1>List of Global Games</h1>


<input type="text" name="search">


<div class="container">
    <div class="row">
        <div class="col-md-4">
            
    @foreach( $api_response as $item)

    <div class="card">
        <div class="card-body">
            <img src={{$item['background_image']}} class="card-img-top" alt="Game image">
            <p class="card-text">{{$item['rating']}}</p>
            <h5 class="card-title">{{$item['name']}}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the</p>
            <a href="#" class="btn btn-primary">Read More</a>
        </div>
    </div>
    
  
@endforeach
          
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card 2</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card 3</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<h2>Try our set made by our developers</h2>
@if ($games_count == 0)
<p> There havent developed yet</p>
@endif

@endsection

</body>
</html>