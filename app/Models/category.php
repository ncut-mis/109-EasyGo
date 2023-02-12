<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'category_id',
        'name',
    ];

    public function products(){
        //一個類別有多個商品
        return $this->hasMany(product::class);
    }
    public function categories(){
        //一個大類別有多個小類別
        return $this->hasMany(category::class);
    }
}
