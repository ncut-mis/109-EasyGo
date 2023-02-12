<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    private function items(){
        //一名會員能選購多項產品
        return $this->hasMany(item::class);
    }
}
