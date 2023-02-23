<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipeImg>
 */
class RecipeImgFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'recipe_id'=>rand(1,14),//食譜編號
            'picture'=>rand(01,10).'.jpg',//食譜圖片
        ];
    }
}
