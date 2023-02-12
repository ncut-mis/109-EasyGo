<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeImg extends Model
{
    use HasFactory;
    protected $fillable = [
        'picture',
    ];

    //某圖片屬於某一食譜
    public function Recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
