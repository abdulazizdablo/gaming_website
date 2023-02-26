<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;




   /**
    * Get the user that owns the Game
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function category(): BelongsTo
   {
       return $this->belongsTo(Category::class);
   }
   public function user ():BelongsTo
   {

    return $this->belongsTo(User::class);


   }
   public function review():BelongsTo
   {

    return $this->morphMany(Review::class,);


   }

    
}
