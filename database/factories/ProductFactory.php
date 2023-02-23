<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \FakerRestaurant\Provider\en_US\Restaurant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));
        return [
            'name'=>$this->faker->foodname(),
            'brand'=>$this->faker->company,
            'stock'=>rand(50,100),
            'origin_place'=>$this->faker->city,
            'norm'=>'/份',
            'price'=>rand(50,150),
            'text'=>$this->faker->realText(199),
        ];
    }
}
