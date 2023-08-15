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
       

       
        $game_name = $request->game_name;

      

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

*/
    }
}
