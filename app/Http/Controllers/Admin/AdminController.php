<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{


public function index(){




}

public function store(){

$this->authorize('create-game');
$game_added = Game::create([


    
])





    
}



    public function dashboard()
    {

        return view('dashborad');
    }
}
