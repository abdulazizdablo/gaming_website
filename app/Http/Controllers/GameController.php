<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GameController extends Controller
{
    use  ApiTrait;

    function __construct()
    {
        /*$this->middleware('permission:create-games|edit-games|delete-games', ['only' => ['index','show']]);
         $this->middleware('permission:create-games', ['only' => ['create','store']]);
         $this->middleware('permission:edit-games', ['only' => ['edit','update']]);
        

         $this->middleware('permission:delete-games', ['only' => ['destroy']]);*/
    }
    public function index()
    {
        $api_response = $this->getApiCustimized();

        // using database driver instead of Eloquent for better performance


        $games_count = DB::table('games')->count();





        /*$rapid_api_key = env('API_RAPID_KEY');


$api_response = Http::withUrlParameters([
    'endpoint' => 'https://api.rawg.io/api/games?',
    'key' => $rapid_api_key
    
])->get('{+endpoint}key={key}');

/*var_dump($api_response->getBody()->getContents());*/
        /*$api_response = json_decode($api_response,true);


// to get the full response usinig api_respnse->json() included headrs and status code
/*$api_response->json();*/


        return view('index')->with('api_response', $api_response)->with('games_count',$games_count);
    }



    public function store(Request $request)
    {
        $developer = auth()->user()->roles;





        $game = Game::create([
            'name' => $request->name,
            'genre' => $request->genre,
            'price' => $request->price,
            'category' => $request->category,
            'added_by' => Auth::user()->id,

        ]);
    }


    public function search(Request $request)
    {

        $query_search = $request->search;

        $search_result = $this->getApiCustimized($query_search);

        return $search_result;
    }

    public function edit(Request $request, Game $game)
    {
        // instead of passing $id as parameter and use Game::find for simpliciy
        // i use model binding teachnique which is Dependency Inject the Model directly and bind the
        // the passed id to the corresponding Model
        $developer = Auth::user();
        // check the realtionship between game and developer made it

        $game_name = $request->game_name;
        !in_array(Auth::user()->games_developed->toArray(), $game_name) ?? redirect()->withMessage("You are not privliged to modify");

        $game = $game->update([
            'name' => $request->name,
            'category' => $request->category,
            'genre' => $request->genre




        ]);
    }
}
