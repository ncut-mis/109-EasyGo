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
            'category_id'=>rand(1,32),
            'quantity'=>rand(1,100),
            'unit'=>$this->faker->randomElement(['個','公克','公升','毫升','份','匙','包','把']),
        ];
    }
}
