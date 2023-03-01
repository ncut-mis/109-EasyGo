<?php

namespace Database\Seeders;

use App\Models\RecipeImg;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecipeImg::truncate();//重制資料表

        RecipeImg::create(['recipe_id' => 1, 'picture' => 'tomato.jpg']);
        RecipeImg::create(['recipe_id' => 2, 'picture' => 'pasta.jpg']);
        RecipeImg::create(['recipe_id' => 3, 'picture' => 'fish1.jpg']);
        RecipeImg::create(['recipe_id' => 3, 'picture' => 'fish2.jpg']);
        RecipeImg::create(['recipe_id' => 4, 'picture' => 'eggplant.jpg']);
        RecipeImg::create(['recipe_id' => 5, 'picture' => 'siumai.jpg']);
        RecipeImg::create(['recipe_id' => 6, 'picture' => 'stew.jpg']);
        RecipeImg::create(['recipe_id' => 7, 'picture' => 'hamburger.jpg']);
    }
}
