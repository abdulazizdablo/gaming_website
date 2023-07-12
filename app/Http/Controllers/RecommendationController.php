<?php

namespace App\Http\Controllers;

use App\Models\Game;

use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function display()
    {

        // displays list of games depending on users previous whislisted on category,genres

    }

    /* making my own recommendation system based on user interaction with games
creating eqaution for determining the user best choice*/


    public function createRecommendation()
    {




        $whishlisted_games = Game::has('whishlist_added')->with('genres')->get();
        $whishlist=$whishlisted_games->whishlist;

        // calcualting the most selected game with common genre and make a priority list from this calculation

        $recommendation_factor = array_count_values($whishlist->genres->toArray());
        $recommendation_factor = arsort($recommendation_factor);

        /*$percantage_factor = array_flip()*/
        // array to determine the percentage that the showing games will be priortized



$recommendation = array_slice($whishlist->genres->toArray(),2,0);


$recommendation_array = array_combine( [ 5/10, 3/10,2/10],$recommendation );
  
    // i will use similarity index in future for now it is prototype

    return collect($recommendation_array );
}

}