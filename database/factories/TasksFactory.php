<?php

namespace Database\Factories;

use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'start' => now(),
            'end' => now(),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Tasks $task) {
            error_log("made {$task->toArray()["id"]}");
        })->afterCreating(function (Tasks $task) {
            error_log("created {$task->toArray()["id"]}");
        });
    }
}
