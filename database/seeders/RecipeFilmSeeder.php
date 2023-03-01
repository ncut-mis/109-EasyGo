<?php

namespace Database\Seeders;

use App\Models\RecipeFilm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecipeFilm::truncate();//重制資料表

        RecipeFilm::create(['recipe_id' => 1, 'film' => '12.mp4']);//番茄炒蛋
        RecipeFilm::create(['recipe_id' => 2, 'film' => '13.mp4']);//義大利麵
        RecipeFilm::create(['recipe_id' => 3, 'film' => '14.mp4']);//檸檬魚
        RecipeFilm::create(['recipe_id' => 4, 'film' => '11.mp4']);//茄子
    }
}
