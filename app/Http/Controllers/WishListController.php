<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Whishlist;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WishListController extends Controller
{

    public function index()
    {

        return view('whislist');
    }
    public function addWhishlist(Request $request)
    {
        dd($request);
        /*::whereHas('game', function ($query) {
        return $query->where('game_id', '=', $game_id);
    })->get(*/


        // check if game was previously added to whishlist by fetching Games Models
        $game_name = $request->game_name;

        /* $checked_game = Game::with('wishlist_added')->whereHas('whishlist_added', function ($query) use ($game_name) {
            $query->where('game_name', $game_name);
        })->get();*/



        /*$checked_game = User::with(['games' => function ($query) {

            $query->where('whislist_added', true);
        }]);*/


        // this functionality is to check the authinticated user if it has 
        // already a game in his whislist
        $whishlist = Auth::user()->whishlist;
        $checked_game = in_array($request->game_name, $whishlist);
        if ($checked_game) {
            $game_whishlist_key = array_search($request->game_name, $whishlist);
            unset($whishlist[$game_whishlist_key]);
            $whishlist->update([$whishlist]);
        }

        // create model realtionship if not exist


        if (!$whishlist) {

            Auth::user()->whishlist->$game_name;
        }

        array_push($whishlist, Auth::user()->whishlist->$game_name);


        // Optimal Query Search

        // Deleting game from database
        /*$checked_game = DB::query('UPDATE users SET whishlist = JSON_REMOVE(whishlist,replace(json_search(whislist,"one",$game_name),""","") WHERE json_search(whishlist, "one", $game_name) IS NOT NULL ');
if(is_null($checked_game)){



}*/


        /*$checked_game = Game::has('whislist_added')
     ->where('whishlist_added',true);*/


        // here if the game with whishlist_added revert the whishlist_added to false thus revert to the default state 
        // or create  a new Whishlist mode;


        // check if the authintecated user hasn't already a whishlist
        /*if (!auth()->user()->whishlist->exists()) {



            $whishlist = Whishlist::create([
                'game_whishlisted' => $request->game_whishlisted,





            ]);
        }*/
    }
}
