<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reading>
 */
class ReadingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'pulse_rate' => fake()->numberBetween(1,120),
            'blood_saturation' => fake()->numberBetween(70,100),
            'systolic' => fake()->numberBetween(70,190),
            'diastolic' => fake()->numberBetween(40,100)
        ];
    }
}
