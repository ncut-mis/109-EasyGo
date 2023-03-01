<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImg;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductImg::truncate();//重製資料表
        $product_imgs=[
            '牛肉'=>'meat.jpg',
            '豬肉'=>'meat.jpg',
            '菠菜'=>'vegetable.jpg',
            '空心菜'=>'vegetable.jpg',
            '蘋果'=>'fruit.jpg',
            '橘子'=>'fruit.jpg',
            '小麥'=>'cereals.jpg',
            '糙米'=>'cereals.jpg',
            '蝦子'=>'seafood.jpg',
            '龍蝦'=>'seafood.jpg',
            '牛奶'=>'dairy.jpg',
            '優酪乳'=>'dairy.jpg',
            '醬油'=>'condiment.jpg',
            '鹽'=>'condiment.jpg',
            '香菇'=>'mushroom.jpg',
            '金針菇'=>'mushroom.jpg'
        ];
        foreach ($product_imgs as $product_img => $info ){
            $id=Category::where('name',$product_img)->first()->id;
            $products=Product::where('category_id',$id)->get();
            foreach ($products as $product){
                ProductImg::factory([
                    'product_id'=>$product->id,
                    'picture'=>$info,
                ])->create();
            }
        }
    }
}
