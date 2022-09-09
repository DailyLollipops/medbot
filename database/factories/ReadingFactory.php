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
        $systolic = fake()->numberBetween(71,190);
        $diastolic = fake()->numberBetween(41,100);
        $blood_pressure = ($systolic-70)/($diastolic-40);
        return [
            'date' => fake()->date('Y-m-d'),
            'pulse_rate' => fake()->numberBetween(1,120),
            'blood_saturation' => fake()->numberBetween(70,100),
            'systolic' => $systolic,
            'diastolic' => $diastolic,
            'blood_pressure' => $blood_pressure,
        ];
    }
}
