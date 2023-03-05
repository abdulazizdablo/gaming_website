<?php

namespace App\Http\Controllers;

use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GameController extends Controller
{
    use  ApiTrait;
  

    public function index()
    {
$api_response = $this->getApiCustimized();
 





        /*$rapid_api_key = env('API_RAPID_KEY');


$api_response = Http::withUrlParameters([
    'endpoint' => 'https://api.rawg.io/api/games?',
    'key' => $rapid_api_key
    
])->get('{+endpoint}key={key}');

/*var_dump($api_response->getBody()->getContents());*/
/*$api_response = json_decode($api_response,true);


// to get the full response usinig api_respnse->json() included headrs and status code
/*$api_response->json();*/

dd($api_response);
return view ('index')->with('api_response',$api_response);


    }



    public function store(Request $req){
      
   


        $game = Game::create([
        'name' => $req->name,
         'genre' => $req->genre,
         'category' => $req->category,
          'added_by' => Auth::user()->id
          
          

         




        ]);





        





    }


public function search(Request $req){





}

public function edit(Request $req , Game $game)
{
// instead of passing $id as parameter and use Game::find for simpliciy
// i use model binding teachnique which is Dependency Inject the Model directly and bind the
// the passed id to the corresponding Model


$game = Game::update([
'name' => $req->name,
'category' => $req->category,
'genre' => $req->genre




])



}
    
}
