<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Suggest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuggestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Suggest::truncate();//重制資料表
        $ingredients=Ingredient::all();//取得所有食材
        foreach ($ingredients as $ingredient){
            $category=$ingredient->category_id;
            $product=Product::where('category_id',$category)->first()->id;
            Suggest::factory([
                'ingredient_id'=>$ingredient->id,
                'product_id'=>$product,
            ])->create();
        }
    }
}
