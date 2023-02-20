<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'recipe_id',
        'category_id',
        'product_id',
        'quantity',
        'unit',
    ];
    public function recipes(){
        //一項食材只屬於一個食譜
        return $this->belongsTo(Recipe::class);
    }
    public function category(){
        //一項食材只能指定一個種類的食材
        return $this->belongsTo(Category::class);
    }
    public function suggest(){
        //一個食材擁有一個建議食材(一對一)
        return $this->hasOne(Suggest::class);
    }
}
