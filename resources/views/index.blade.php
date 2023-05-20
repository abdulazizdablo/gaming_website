
@extends('layouts.app');

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

 
   
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
            <input  class ="game_name" name="game_name" type="checkbox" id="animationTrigger"  value={{$item['name']}}/>

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
 <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
  
 
    $("#add_whishlist").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            game_name: $('.game_name').val(),
           
        };
        console.log(formData)
        var type = "post";
       
        var ajaxurl = "{{route('addtoWhishlist')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            success: function (data) {
            console.log(formData)
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
})
</script>;
</body>
</html>