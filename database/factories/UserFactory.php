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

        $birthday_start = strtotime("1960-1-01 00:00:00");
        $birthday_end =  strtotime("2016-12-31 23:59:59");
        $random_birthday = date("Y-m-d H:i:s", rand($birthday_start, $birthday_end));

        $created_start = strtotime("2022-1-01 00:00:00");
        $created_end =  strtotime("2022-9-31 23:59:59");
        $random_created = date("Y-m-d H:i:s", rand($created_start, $created_end));
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'birthday' => $random_birthday,
            'gender' => $this->faker->randomElement(['female','male']),
            'address' => fake()->address(),
            'bio' => fake()->paragraph(2),
            // 'phone_number' => $number,
            'email_verified_at' => now(),
            'password' => bcrypt('lollipop'), // password
            'remember_token' => Str::random(10),
            'type' => $this->faker->randomElement(['doctor','normal']),
            'created_at' => $random_created
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
