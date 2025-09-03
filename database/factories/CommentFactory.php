<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Issue;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'issue_id' => Issue::factory(),
            'author_name' => fake()->name(),
            'body' => fake()->sentences(rand(1,3), true),
        ];
    }
}
