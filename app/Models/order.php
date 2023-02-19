<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
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
}
