<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Str::random(14),
            'destination' => Str::random(10),
            'description' => Str::random(25),
            'start_date' => $this->faker->dateTimeBetween(now(), now()->addMonths(2)),
            'end_date' => $this->faker->dateTimeBetween(now()->addMonths(3), now()->addMonths(5)),
            'max_registrations' => $this->faker->unique()->numberBetween(20, 100),
        ];
    }
}
