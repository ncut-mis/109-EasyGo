<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_img extends Model
{
    use HasFactory;
    protected $fillable=[
      'id',
      'product',
      'picture',
    ];

    public function product(){
        //一張圖片只有一個商品
        return $this->belongsTo(Product::class);
    }
}
