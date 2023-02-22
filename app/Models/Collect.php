<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'member_id',
        'recipe_id',
    ];

    //一項收藏食譜只屬於一個食譜(一對一)
    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }

    //一項收藏食譜只能指定一個會員(一對多)
    public function member(){
        return $this->belongsTo(Member::class);
    }

}
