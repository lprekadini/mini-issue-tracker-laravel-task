<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;

class IssueFactory extends Factory
{
    public function definition(): array
    {
        $statuses = ['open','in_progress','closed'];
        $priorities = ['low','medium','high'];
        return [
            'project_id' => Project::factory(),
            'title' => fake()->sentence(5),
            'description' => fake()->paragraphs(2, true),
            'status' => $statuses[array_rand($statuses)],
            'priority' => $priorities[array_rand($priorities)],
            'due_date' => now()->addDays(rand(1,60))->toDateString(),
        ];
    }
}
