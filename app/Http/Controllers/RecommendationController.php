<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    /**
     * Display a list of recommended games based on user's wishlist.
     */
    public function display()
    {
        // Get the recommended games
        $recommendations = $this->createRecommendation();

        // Return the view with recommended games
        return view('games.index', compact('recommendations'));
    }

    /**
     * Create a list of recommended games based on user's wishlist.
     */
    public function createRecommendation()
    {
        // Get games from the wishlist
        $wishlistGames = Game::has('wishlist_added')->with('genres')->get();

        // Calculate the recommendation factor
        $recommendationFactor = $this->calculateRecommendationFactor($wishlistGames);

        // Determine the prioritized games
        $prioritizedGames = $this->determinePrioritizedGames($recommendationFactor);

        return $prioritizedGames;
    }

    /**
     * Calculate the recommendation factor based on genres.
     */
    private function calculateRecommendationFactor($wishlistGames)
    {
        $recommendationFactor = [];

        foreach ($wishlistGames as $game) {
            foreach ($game->genres as $genre) {
                $genreName = $genre->name;
                $recommendationFactor[$genreName] = ($recommendationFactor[$genreName] ?? 0) + 1;
            }
        }

        // Sort the recommendation factor in descending order
        arsort($recommendationFactor);

        return $recommendationFactor;
    }

    /**
     * Determine the prioritized games based on the recommendation factor.
     */
    private function determinePrioritizedGames($recommendationFactor)
    {
        // Define the percentage factors for prioritization
        $percentageFactors = [
            'High' => 5 / 10,
            'Medium' => 3 / 10,
            'Low' => 2 / 10,
        ];

        // Calculate the prioritized games based on the percentage factors
        $prioritizedGames = [];

        foreach ($percentageFactors as $factor => $percentage) {
            foreach ($recommendationFactor as $genre => $count) {
                $prioritizedGames[$factor][] = $genre;
            }
        }

        return $prioritizedGames;
    }
}
