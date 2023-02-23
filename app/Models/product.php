<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
        return $this->belongsTo(Category::class);
    }
    public function product_imgs(){
        //一個產品有多張照片
        return $this->hasMany(ProductImg::class);
    }
    public function items(){
        //一個產品能被多次選購
        return $this->hasMany(Item::class);
    }
    public function order_details(){
        //一個產品能被多次購買
        return $this->hasMany(Order_detali::class);
    }
    public function suggests(){
        //一個商品能被多項建議食材指定
        return $this->hasMany(Suggest::class);
    }
}
