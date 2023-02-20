<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'ingredient_id',
        'product_id',
    ];

    public function ingredient(){
        //一向建議食材只屬於一個食材(一對一)
        return $this->belongsTo(Ingredient::class);
    }
    public function product(){
        //一項建議食材只能指定一個商品(一對多)
        return $this->belongsTo(Product::class);
    }
}
