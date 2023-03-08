<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'recipe_category_id',
        'user_id',
        'name',
        'text',
        'status',
    ];

    //某食譜屬於某一會員
    public function user(){
        return $this->belongsTo(User::class);
    }

    //某食譜屬於某一食譜種類
    public function recipecategory(){
        return $this->belongsTo(RecipeCategory::class);
    }

    //一個食譜擁有一個收藏食譜(一對一)
    public function collect(){
        return $this->hasOne(Collect::class);
    }

    //一個食譜可擁有多則留言(一對多)
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //一個食譜可擁有多個照片(一對多)
    public function recipeimgs(){
        return $this->hasMany(RecipeImg::class);
    }

    //一個食譜可擁有多個影片(一對多)
    public function recipefilms(){
        return $this->hasMany(RecipeFilm::class);
    }

    //一個食譜可擁有多個步驟(一對多)
    public function recipesteps(){
        return $this->hasMany(RecipeStep::class);
    }

    public function ingredients(){
        //一份食譜擁有多項食材
        return $this->hasMany(Ingredient::class);
    }
}
