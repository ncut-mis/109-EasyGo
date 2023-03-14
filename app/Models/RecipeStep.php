<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'recipe_id',
        'sequence',
        'text',
        'picture',
    ];

    //某步驟屬於某一食譜
    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
