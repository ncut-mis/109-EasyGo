<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'category_id',
        'name',
        'brand',
        'stock',
        'origin_place',
        'norm',
        'price',
        'text',
    ];

    public function category(){
        //一個商品只有一個種類
        return $this->belongsTo(category::class);
    }
    public function product_img(){
        //一個產品有多張照片
        return $this->hasMany(product_img::class);
    }
}
