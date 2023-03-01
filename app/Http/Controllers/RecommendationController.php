<?php

namespace App\Http\Controllers;
use App\Models\Game;

use Illuminate\Http\Request;

class RecommendationController extends Controller
{
 public function display(){

// displays list of games depending on users previous visits on category,genres


 }

/* making my own recommendation system based on user interaction with games
creating eqaution for determining the user best choice*/


public function createRecommendation(){
/
$whishlisted_games = Game::has('whishlist_added')->with('genres')->get();

// calcualting the most selected game with common genre and make a priority list from this calculation

$recommendation_factor = array_count_values($whishlisted_games->genres->toArray());
$recommendation_factor = arsort($recommendation_factor);


    
}

}
