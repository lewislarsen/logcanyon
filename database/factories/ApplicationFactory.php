<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'label' => fake()->sentence,
            'secret_key' => fake()->uuid,
            'last_logs_sent_at' => null,
            'site_url' => fake()->url,
        ];
    }
}
