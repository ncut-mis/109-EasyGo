<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecipeCategory::truncate();//重制資料表
        Recipe::truncate();//重制資料表

        RecipeCategory::factory([
            'name' => '中式',//類別名稱
        ])->has(Recipe::factory(2))->create();

        RecipeCategory::factory([
            'name' => '西式',//類別名稱
        ])->has(Recipe::factory(2))->create();

        RecipeCategory::factory([
            'name' => '泰式',//類別名稱
        ])->has(Recipe::factory(2))->create();

        RecipeCategory::factory([
            'name' => '義式',//類別名稱
        ])->has(Recipe::factory(2))->create();

        RecipeCategory::factory([
            'name' => '港式',//類別名稱
        ])->has(Recipe::factory(2))->create();

        RecipeCategory::factory([
            'name' => '法式',//類別名稱
        ])->has(Recipe::factory(2))->create();

        RecipeCategory::factory([
            'name' => '日式',//類別名稱
        ])->has(Recipe::factory(2))->create();
    }
}
