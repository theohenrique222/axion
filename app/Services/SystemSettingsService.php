<?php

namespace App\Services;

use App\Models\SystemSetting;
use RuntimeException;

class SystemSettingsService
{
    protected ?SystemSetting $settings = null;

    public function isSetupCompleted(): bool
    {
        return $this->settings()->setup_completed;
    }

    public function currentStep(): int
    {
        return $this->settings()->setup_step;
    }

    public function markSetupAsCompleted(): void
    {
        $settings = $this->settings();
        $settings->update([
            'setup_completed' => true,
            'setup_step' => 0,
        ]);

        $this->settings = $settings->fresh();
    }

    public function markSettingsAsCompleted(int $step): void
    {
        $settings = $this->settings();
        $settings->update(['setup_step' => $step]);

        $this->settings = $settings->fresh();
    }

    public function initialize(?string $systemName = null): SystemSetting
    {
        if ($this->settings !== null) {
            return $this->settings;
        }

        $settings = SystemSetting::first();

        if ($settings === null) {
            $settings = SystemSetting::create([
                'system_name' => $systemName ?? config('app.name'),
                'setup_completed' => false,
                'setup_step' => 0,
            ]);
        }

        $this->settings = $settings;

        return $settings;
    }

    public function refresh(): void
    {
        $this->settings = null;
    }

    public function settings(): SystemSetting
    {
        if ($this->settings === null) {
            $this->settings = SystemSetting::first();

            if ($this->settings === null) {
                throw new RuntimeException(
                    'System settings have not been initialized. Run the migrations and ensure a settings record exists.'
                );
            }
        }

        return $this->settings;
    }

    public function getSystemName(): ?string
    {
        return $this->settings()->system_name;
    }
}
