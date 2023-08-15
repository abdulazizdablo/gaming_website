<?php

namespace App\Http\Controllers;

use App\Traits\ApiTrait;
use Illuminate\Support\Facades\DB;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    use ApiTrait;
    function __construct()
    {
        /*$this->middleware('permission:create-games|edit-games|delete-games', ['only' => ['index','show']]);
         $this->middleware('permission:create-games', ['only' => ['create','store']]);
         $this->middleware('permission:edit-games', ['only' => ['edit','update']]);
        

         $this->middleware('permission:delete-games', ['only' => ['destroy']]);*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $api_response = $this->getApiCustimized();

        // using database driver instead of Eloquent for better performance


        $games_count = DB::table('games')->count();

Cache::remember('games', 900, function ( $api_response) {
    return $api_response;
});

        return view('index')->with('api_response', $api_response)->with('games_count', $games_count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('game.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('game_file');
        $game_name = $request->input('game_name');
        $game_file_name = $file->getClientOriginalName();
        $game_file_path = storage_path('app/games/' . $game_name . '/' . $game_file_name);
        $file->move($game_file_path);


        $game = Game::create([
            'name' => $request->name,
            'genre' => $request->genre,
            'price' => $request->price,
            'category' => $request->category,
            'added_by' => Auth::user()->id,

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        $views = views($game)
            ->cooldown($minutes = 3)
            ->record();
    }
public function gameDetails(Request $request){

$query_param = $request->slug;


return $this->getApiCustimized($query_param);

}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('games.edit')->with('game', $game);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        // instead of passing $id as parameter and use Game::find for simpliciy
        // i use model binding teachnique which is Dependency Inject the Model directly and bind the
        // the passed id to the corresponding Model
        $developer = Auth::user();
        // check the realtionship between game and developer made it

        $game_name = $request->game_name;
        !in_array(Auth::user()->games_developed->toArray(), $game_name) ?? redirect()->withMessage("You are not privliged to modify");

        $game->update([
            'name' => $request->name,
            'category' => $request->category,
            'genre' => $request->genre




        ]);
    }
    public function search(Request $request)
    {

        $query_search = $request->search;

        $search_result = $this->getApiCustimized($query_search);

        return $search_result;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {

        $game->delete();
    }

    public function rate(Request $request){



    }
}
