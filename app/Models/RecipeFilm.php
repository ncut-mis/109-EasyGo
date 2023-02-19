<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeFilm extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'recipe_id',
        'film',
    ];

    //某影片屬於某一食譜
    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
