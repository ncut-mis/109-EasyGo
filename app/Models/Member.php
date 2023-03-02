<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'nickname',
        'phone',
        'address',
    ];

    //某會員屬於user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //一個會員可儲存多張信用卡(一對多)
    public function cards(){
        return $this->hasMany(Card::class);
    }

    //一個會員能收藏多個食譜
    public function collects(){
        return $this->hasMany(Collect::class);
    }

    //一個會員可留下多個留言(一對多)
    public function comment(){
        return $this->hasMany(Comment::class);
    }

    private function items(){
        //一名會員能選購多項產品
        return $this->hasMany(item::class);
    }

    public function orders(){
        //一名會員傭有多筆訂單
        return $this->hasMany(order::class);
    }

}
