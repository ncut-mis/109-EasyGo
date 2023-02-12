<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'category_id',
        'name',
        'brand',
        'stock',
        'origin_place',
        'norm',
        'price',
        'text',
    ];
}
