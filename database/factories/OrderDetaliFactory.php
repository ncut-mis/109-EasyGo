<?php

namespace Database\Factories;

use App\Models\OrderDetali;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetali>
 */
class OrderDetaliFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id'=>rand(1,32),
            'quantity'=>rand(1,10),
        ];
    }
}
