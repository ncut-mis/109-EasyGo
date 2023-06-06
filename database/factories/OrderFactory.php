<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'remit'=>1,
            'status'=>rand(0,7),
            'receiver'=>$this->faker->name,
            'address'=>$this->faker->address,
            'tel'=>$this->faker->phoneNumber,
        ];
    }
}
