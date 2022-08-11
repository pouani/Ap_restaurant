<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'adresse'=>$this->faker->address(),
            'menu'=>$this->faker->sentence(rand(1,3), true),
            'image' => $this->faker->imageUrl(),
            'active' => $this->faker->boolean(80)
        ];
    }
}
