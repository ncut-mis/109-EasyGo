<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'member_id',
        'remit',
        'status',
        'receiver',
        'address',
        'tel',
    ];

    public function member(){
        //一筆訂單屬於一個會員
        return $this->belongsTo(Member::class);
    }
    public function order_detalis(){
        //一筆訂單有多則訂單明細
        return $this->hasMany(Order_detali::class);
    }
}
