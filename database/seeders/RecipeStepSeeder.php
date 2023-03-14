<?php

namespace Database\Seeders;

use App\Models\RecipeStep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecipeStep::truncate();//重製資料表
        for ($i = 1; $i <= 7; $i++) {
            for ($j = 1; $j <= 3; $j++){
                RecipeStep::factory(['recipe_id' => $i,'sequence' => $j])->create();//每個食譜新增三個步驟
            }
        }
    }
}
