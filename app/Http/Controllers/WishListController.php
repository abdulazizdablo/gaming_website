<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishListController extends Controller
{

public function index(){

return view('whislist');


}
public function addWhishlist(Request $req){

    Whishlist::whereHas('game', function ($query) {
        return $query->where('game_id', '=', game_id);
    })->get(
   $whishlist = Whishlist ::create([
    'game_add' => $req->game_add,




   ])




}


}
