<div class="card">
    <div class="card-body">
        <img src={{$item['background_image']}} class="card-img-top" alt="Game image">
        <p class="card-text">{{$item['rating']}}</p>
        <h5 class="card-title">{{$item['name']}}</h5>
        <p class="card-text">Get to know more click on the button</p>
        <p class="card-text">{{$item['description']}}</p>
        <a href="#" class="btn btn-primary"><input  type="button" placeholder="See more" value= {{$item['slug']}}/></a>
        <input  class ="game_name" name="game_name" type="checkbox"   value={{$item['name']}}/>

    </div>
</div>