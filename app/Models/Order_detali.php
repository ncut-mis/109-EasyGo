<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detali extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'order_id',
        'product_id',
        'quantity',
    ];

    public function order(){
        //一則訂單明細只屬於一筆訂單
        return $this->belongsTo(Order::class);
    }
    public function product(){
        //一則訂單明細只顯示一項商品
        return $this->belongsTo(Product::class);
    }
}
