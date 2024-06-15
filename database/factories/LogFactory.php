<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'application_id' => Application::factory()->create()->id,
            'level' => $this->faker->randomElement(['DEBUG', 'INFO', 'NOTICE', 'WARNING', 'ERROR', 'CRITICAL', 'ALERT', 'EMERGENCY']),
            'message' => $this->faker->sentence,
            'context' => $this->faker->sentence,
        ];
    }
}
