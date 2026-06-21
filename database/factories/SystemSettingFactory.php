<?php

namespace Database\Factories;

use App\Models\SystemSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SystemSetting>
 */
class SystemSettingFactory extends Factory
{
    protected $model = SystemSetting::class;

    public function definition(): array
    {
        return [
            'system_name' => fake()->company(),
            'setup_completed' => false,
            'setup_step' => 0,
        ];
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'setup_completed' => true,
            'setup_step' => 0,
        ]);
    }

    public function onStep(int $step): static
    {
        return $this->state(fn (array $attributes) => [
            'setup_completed' => false,
            'setup_step' => $step,
        ]);
    }
}
