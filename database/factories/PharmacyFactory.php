<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->realText(rand(80, 600)),
            'logo' => $this->faker->imageUrl(200, 200),
        ];
    }
}
