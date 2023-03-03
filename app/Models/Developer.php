<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Developer extends Model
{
    use HasFactory, HasRoles;


    protected $guard = 'developer';



    protected $fillable = ['id', 'name', 'slug',];

    public function game()
    {

        return $this->hasMany(Games::class);
    }
}
