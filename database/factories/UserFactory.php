<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $start = strtotime("1960-1-01 00:00:00");
        $end =  strtotime("2016-12-31 23:59:59");
        
        $created = date("Y-m-d H:i:s", rand($start, $end));

        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'birthday' => $created,
            'gender' => $this->faker->randomElement(['gender','male']),
            'address' => fake()->cityName,
            'bio' => fake()->paragraph(3),
            'phone_number' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => bcrypt('lollipop'), // password
            'remember_token' => Str::random(10),
            'type' => $this->faker->randomElement(['doctor','normal'])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
