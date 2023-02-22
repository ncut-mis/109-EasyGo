<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
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
        Product::truncate();//重制資料表
        $faker=Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));


        Category::factory([
            'name'=>'肉類'
        ])->has(Category::factory(
            [['name'=>'牛肉']]
        ))->has(Product::factory(5,['name'=>$faker->meatname()]))->create();

        Category::factory([
            'name'=>'蔬菜類'
        ])->has(Category::factory(
            ['name'=>'菠菜'],
        ))->has(Product::factory(5,['name'=>$faker->vegetableName()]))->create();

        Category::factory([
            'name'=>'水果類'
        ])->has(Category::factory(
            ['name'=>'蘋果'],
        ))->has(Product::factory(5,['name'=>$faker->fruitName()]))->create();

        Category::factory([
            'name'=>'醬類'
        ])->has(Category::factory(
            ['name'=>'醬油'],
        ))->has(Product::factory(5,['name'=>$faker->sauceName()]))->create();

    }
}
