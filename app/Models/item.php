<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'member_id',
        'product',
        'quantity',
    ];

    public function product(){
        //一個選購資料只能有一個商品
        return $this->belongsTo(product::class);
    }
    public function member(){
        //一個選購資料只屬於一個會員
        return $this->belongsTo(Member::class);
    }
}
