<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phone'=>$this->faker->phoneNumber(),//電話
            'address'=>$this->faker->address,//地址
            'nickname'=>$this->faker->userName,//暱稱
        ];
    }
}
