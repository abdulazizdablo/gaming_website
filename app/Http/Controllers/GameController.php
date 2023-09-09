<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;
use App\Traits\ApiTrait;

class GameController extends Controller
{
    use ApiTrait;

    public function index()
    {
        $apiResponse = $this->getApiCustomized();
        $gamesCount = Game::count();

        Cache::remember('games', 900, function () use ($apiResponse) {
            return $apiResponse;
        });

        return view('index')->with('apiResponse', $apiResponse)->with('gamesCount', $gamesCount);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'game_name' => 'required',
            'game_file' => 'required|file',
            'name' => 'required',
            'genre' => 'required',
            'price' => 'required',
            'category' => 'required',
        ]);

        $gameName = $request->input('game_name');
        $gameFileName = $request->file('game_file')->getClientOriginalName();
        $gameFilePath = storage_path("app/games/{$gameName}/{$gameFileName}");

        $request->file('game_file')->move($gameFilePath);

        auth()->user()->games()->create([
            'name' => $request->input('name'),
            'genre' => $request->input('genre'),
            'price' => $request->input('price'),
            'category' => $request->input('category')
        ]);
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function update(UpdateGameRequest $request, Game $game)
    {
    

        $game->update($request->validated());
    }

    public function destroy(Game $game)
    {
        $game->delete();
    }

  

    public function filterApiElements(string $filterDataDetermination)
    {
        $collectionApiResult = collect($this->getApiCustomized())->groupBy(function ($item) use ($filterDataDetermination) {
            if ($filterDataDetermination == 'genres') {
                return $item['genres'][0]['name'];
            }
            return $item[$filterDataDetermination];
        })->keyBy(function ($item) {
            return $item['name'];
        });

        return $collectionApiResult;
    }

    // Other methods...
}
