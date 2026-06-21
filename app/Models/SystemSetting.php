<?php

namespace App\Models;

use Database\Factories\SystemSettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int|null $company_id
 * @property string|null $system_name
 * @property bool $setup_completed
 * @property int $setup_step
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Company|null $company
 */
class SystemSetting extends Model
{
    /** @use HasFactory<SystemSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'company_id',
        'system_name',
        'setup_completed',
        'setup_step',
    ];

    protected function casts(): array
    {
        return [
            'setup_completed' => 'boolean',
            'setup_step' => 'integer',
        ];
    }

    /** @return BelongsTo<Company, $this> */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
