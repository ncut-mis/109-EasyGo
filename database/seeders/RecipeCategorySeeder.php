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

        RecipeCategory::create(['name' => '中式']);
        RecipeCategory::create(['name' => '義式']);
        RecipeCategory::create(['name' => '泰式']);
        RecipeCategory::create(['name' => '日式']);
        RecipeCategory::create(['name' => '港式']);
        RecipeCategory::create(['name' => '法式']);
        RecipeCategory::create(['name' => '美式']);
    }
}
