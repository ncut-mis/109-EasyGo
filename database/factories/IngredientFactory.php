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
            'quantity'=>$this->faker->randomElement(['1/個','100/公克','100/公升','100/毫升','2/份','0.5/匙','1/包','2/把']),
            'name'=>$this->faker->randomElement(['魚','牛肉','醬油','金針菇','牛奶','菠菜']),
        ];
    }
}
