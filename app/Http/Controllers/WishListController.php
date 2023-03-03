<?php

namespace App\Http\Controllers;

use App\Models\Whishlist;
use App\Models\Game;
use Illuminate\Http\Request;

class WishListController extends Controller
{

    public function index()
    {

        return view('whislist');
    }
    public function addWhishlist(Request $req)
    {

        /*::whereHas('game', function ($query) {
        return $query->where('game_id', '=', $game_id);
    })->get(*/


        // check if game was previously added to whishlist by fetching Games Models
        $game_name = $req->game_name;

        $checked_game = Game::whereHas('whishlist_added', function ($query) use ($game_name) {
            $query->where('game_name', $game_name);
        })->get();

        // here if the game with whishlist_added revert the whishlist_added to false thus revert to the default state 
        // or create  a new Whishlist mode;
        $checked_game ?? $checked_game->whihslist_added->update(['whishlist_added' => !$checked_game->whihslist_added]);


        // check if the authintecated user hasn't already a whishlist
        if (!auth()->user()->whishlist->exists()) {



            $whishlist = Whishlist::create([
                'game_whishlisted' => $req->game_whishlisted,





            ]);
        }
    }
}
