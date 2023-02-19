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

    //一個會員可擁有多個食譜(一對多)
    public function recipes(){
        return $this->hasMany(Recipe::class);
    }

    //一個會員可儲存多張信用卡(一對多)
    public function cards(){
        return $this->hasMany(Card::class);
    }

    //一個會員可留下多個留言(一對多)
    public function comment(){
        return $this->hasMany(Comment::class);
    }

    //每個會員可能收藏多個食譜
    public function recipe(){
        return $this->belongsToMany(Recipe::class,'collects')
                    ->withPivot('member_id','recipe_id')//pivot屬性代表中介表的模型(此為collects)，可像其它的 Eloquent 模型一樣被使用
                    ->withTimestamps();//自動維護 created_at 和 updated_at 時間戳記
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
