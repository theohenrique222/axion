<?php

namespace App\Facades;

use App\Services\SystemSettingsService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool isSetupCompleted()
 * @method static int currentStep()
 * @method static void markSetupAsCompleted()
 * @method static void advanceSetupStep(int $step)
 * @method static \App\Models\SystemSetting initialize(?string $systemName = null)
 * @method static void refresh()
 * @method static \App\Models\SystemSetting settings()
 * @method static string|null getSystemName()
 *
 * @see SystemSettingsService
 */
class SystemSettings extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'system.settings';
    }
}
