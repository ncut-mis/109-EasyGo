<?php

namespace Database\Seeders;

use App\Models\Category;
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

        Category::factory([
            'name'=>'肉類'
        ])->has(Category::factory(
            ['name'=>'牛肉'],
        ))->create();

        Category::factory([
            'name'=>'蔬菜類'
        ])->has(Category::factory(
            ['name'=>'菠菜'],
        ))->create();

        Category::factory([
            'name'=>'水果類'
        ])->has(Category::factory(
            ['name'=>'蘋果'],
        ))->create();

        Category::factory([
            'name'=>'菇類'
        ])->has(Category::factory(
            ['name'=>'香菇'],
        ))->create();
    }
}
