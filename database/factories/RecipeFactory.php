<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'member_id'=>rand(1,10),//會員編號
            'name' => $this->faker->sentence(2),//食譜名稱
            'text' =>$this->faker->text('200'),//介紹
        ];
    }
}
