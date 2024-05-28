<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(6);
        return [
            "slug" => Str::slug($title),
            "title" => $title,
            "body" => fake()->paragraph(50),
            // 'author_id' => mt_rand(2, 10),
            'author_id' => User::factory(),
        ];
    }
}
