<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id'=>$this->faker->randomElement([2,3,5,6,8,9,11,12,14,15,17,18,20,21,23,24]),
            'quantity'=>rand(1,100),
            'unit'=>$this->faker->randomElement(['個','公克','公升','毫升','份','匙','包','把']),
        ];
    }
}
