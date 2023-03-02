<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Member;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::truncate();//重制資料表
        Ingredient::truncate();//重制資料表

            Recipe::factory(['name' => '番茄炒蛋', 'text' => '原材料易於搜集，製作步驟也較為簡單，大人小孩都愛吃。', 'recipe_category_id' => 1, 'user_id' => 1])->has(Ingredient::factory(5))->create();//中
            Recipe::factory(['name' => '蒜味鮮蝦義大利麵', 'text' => '這是一道輕鬆完成的主餐，適合一個人獨享或多人分食，美味簡單料理，整份料理的口感層次豐富。', 'recipe_category_id' => 2, 'user_id' => 2])->has(Ingredient::factory(5))->create();//義
            Recipe::factory(['name' => '泰式檸檬魚', 'text' => '如果平常對魚味很敏感，推薦將這道料理學起來，異國美味清爽可口。', 'recipe_category_id' => 3, 'user_id' => 3])->has(Ingredient::factory(5))->create();//泰
            Recipe::factory(['name' => '醬燒茄子', 'text' => '入口即化非常好吃，超級下飯!一秒愛上茄子的神奇料理。', 'recipe_category_id' => 4, 'user_id' => 4])->has(Ingredient::factory(5))->create();//日
            Recipe::factory(['name' => '燒賣', 'text' => '多做一點可以冷凍起來，連吃好幾天，喜歡吃港式料理的朋友學起來。', 'recipe_category_id' => 5, 'user_id' => 4])->has(Ingredient::factory(5))->create();//港
            Recipe::factory(['name' => '普羅旺斯燉菜', 'text' => '法國家常料理，電影料理鼠王經典餐點，和孩子們一起還原電影場景。', 'recipe_category_id' => 6, 'user_id' => 5])->has(Ingredient::factory(5))->create();//法
            Recipe::factory(['name' => '培根花生醬起司牛肉漢堡', 'text' => '地道美式餐廳招牌花生醬漢堡，鹹甜鹹甜~初戀的感覺。', 'recipe_category_id' => 7, 'user_id' => 5])->has(Ingredient::factory(5))->create();//美
    }
}
