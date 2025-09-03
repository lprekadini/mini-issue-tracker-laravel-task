<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
            'description' => fake()->paragraph(),
            'start_date' => now()->subDays(rand(0,60))->toDateString(),
            'deadline' => now()->addDays(rand(10,90))->toDateString(),
        ];
    }
}
