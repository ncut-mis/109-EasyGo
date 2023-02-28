<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImg;
use Database\Factories\ProductImgFactory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();//重制資料表
        $types = [
            '肉類'=>['豬肉','牛肉'],
            '蔬菜'=>['菠菜','空心菜'],
            '水果'=>['蘋果','橘子'],
            '穀物'=>['小麥','糙米'],
            '海鮮'=>['蝦子','龍蝦'],
            '奶類'=>['牛奶','優酪乳'],
            '調味'=>['醬油','鹽'],
            '菇類'=>['香菇','金針菇']
        ];
        foreach ($types as $type=>$info ){
            Category::factory([
                'name'=>$type
            ])->create();
            foreach ($info as $item){
                Category::factory([
                    'name'=>$item,
                    'category_id'=>Category::where('name',$type)->first()->id
                ])
                ->create();
            }
        }
    }
}
