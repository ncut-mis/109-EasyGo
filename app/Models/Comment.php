<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'member_id',
        'recipe_id',
        'comment_id',
        'content',
        'time',
    ];

    //某則留言屬於某一會員
    public function member(){
        return $this->belongsTo(Member::class);
    }

    //某則留言屬於某一食譜
    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }

    //一則留言可被多則留言回復(一對多)
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //多則回覆留言再某一留言下
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}
