<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Game extends Model
{
    use HasFactory,InteractsWithViews;


    protected $fillable = ['name', 'genre', 'added_by', 'image'];



    /**
     * Get the user that owns the Game
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }

    public function wishlist()
    {
        return $this->belongsToMany(Game::class, 'wishlist', 'user_id', 'game_id');
    }
    

    public function review()
    {

        return $this->morphMany(Review::class, 'reviewable');
    }
}
