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
            'status' =>rand(1,2),//食譜上下架狀態(1為上架、2為下架)
            'name' => $this->faker->sentence(1),//食譜名稱
            'text' =>$this->faker->realText(199),//介紹
        ];
    }
}
