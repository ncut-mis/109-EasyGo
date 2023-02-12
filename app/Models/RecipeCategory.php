<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function recipes(){
        //一個食譜種類擁有多個食譜(一對多)
        return $this->hasMany(Recipe::class);
    }
}
