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

        RecipeImg::factory(10)->create();
    }
}
