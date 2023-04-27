
@extends('layouts.app');

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="..\.\css\star.scss">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1>List of Global Games</h1>


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
            <input type="checkbox" id="animationTrigger" />
<label for="animationTrigger" class="animation-trigger"></label>

<svg class="star" viewBox="0 0 114 110">
		<path d="M48.7899002,5.95077319 L39.3051518,35.1460145 L8.60511866,35.1460145 C4.87617094,35.1519931 1.57402643,37.5554646 0.422104463,41.1020351 C-0.7298175,44.6486057 0.529798011,48.5337314 3.54354617,50.7297298 L28.3840111,68.7758317 L18.8992627,97.971073 C17.7496089,101.520283 19.0141379,105.406227 22.0323508,107.599168 C25.0505637,109.792109 29.1370771,109.794067 32.1573906,107.604021 L56.9864557,89.5693186 L81.8269206,107.615421 C84.8472342,109.805467 88.9337475,109.803509 91.9519605,107.610568 C94.9701734,105.417627 96.2347024,101.531683 95.0850486,97.9824729 L85.6003001,68.7986315 L110.440765,50.7525296 C113.466376,48.5582894 114.732852,44.663975 113.576698,41.1097771 C112.420545,37.5555791 109.105303,35.1516627 105.367793,35.1574144 L74.6677595,35.1574144 L65.1830111,5.96217312 C64.0286485,2.41064527 60.7208743,0.00457304502 56.9864557,5.53367114e-06 C53.2527571,-0.00420898295 49.9421526,2.39931752 48.7899002,5.95077319 Z"/>
</svg>

<div class="circle"></div>

<p class="click-me info">
   Click me!
</p>

<p class="click-me whoa">
   Whoa! :D
</p>
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