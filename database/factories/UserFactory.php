<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $day = mt_rand(1, 28);
        $month = mt_rand(1, 12);
        $year = mt_rand(1990, 2002);
        $birthday_date = sprintf('%04d-%02d-%02d', $year, $month, $day);

        $gender = mt_rand(0, 1) == 0 ? 'male' : 'female';
        $first_name = fake()->firstName($gender);
        $last_name = fake()->lastName($gender);
        return [
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'is_admin' => false,

            // $a = $a ? $a : $b; // ternary operator
            // $a = $a ?: $b;     // elvis operator
            // $a ??= $b;         // null coalescing operator

            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'phone_number' => fake()->e164PhoneNumber(),
            'is_whatsapp_number' => $gender == "male",
            'address' => fake()->address(),
            'permanent_address' => fake()->address(),
            'birthday_date' => $birthday_date,

            'activation_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'activation_at' => null,
        ]);
    }
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => true,
        ]);
    }
}
