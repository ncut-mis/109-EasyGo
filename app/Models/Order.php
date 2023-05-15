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
        'remark',
    ];

    public function member(){
        //一筆訂單屬於一個會員
        return $this->belongsTo(Member::class);
    }
    public function orderDetali(){
        //一筆訂單有多則訂單明細
        return $this->hasMany(OrderDetali::class);
    }
}
