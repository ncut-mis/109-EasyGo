<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'member_id',
        'number',
        'check',
        'deadline',
    ];

    //某張信用卡屬於某一會員
    public function member(){
        return $this->belongsTo(Member::class);
    }
}
