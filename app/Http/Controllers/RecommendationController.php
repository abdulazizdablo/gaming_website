<?php

namespace App\Http\Controllers;

use App\Models\Game;

use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function display()
    {

        // displays list of games depending on users previous visits on category,genres


    }

    /* making my own recommendation system based on user interaction with games
creating eqaution for determining the user best choice*/


    public function createRecommendation()
    {

        $whishlisted_games = Game::has('whishlist_added')->with('genres')->get();

        // calcualting the most selected game with common genre and make a priority list from this calculation

        $recommendation_factor = array_count_values($whishlisted_games->genres->toArray());
        $recommendation_factor = arsort($recommendation_factor);

        /*$percantage_factor = array_flip()*/
        // array to determine the percentage that the showing games will be priortized

        $recommandation_percantage_elemtents = [
            "50%" => $recommendation_factor[0],

            "30%" => $recommendation_factor[1],
            "20%" => $recommendation_factor[2],
        ];
    }
}
return collect($recommandation_percantage);
