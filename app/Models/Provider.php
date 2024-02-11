<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $organization_name
 * @property string $provider_full_name
 * @property int $country_id
 * @property string $organization_address
 * @property string $phone
 * @property string $email
 * @property string $organization_info
 * @property array $files
 */
class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_name',
        'provider_full_name',
        'country_id',
        'organization_address',
        'phone',
        'email',
        'organization_info',
        'files'
    ];

    protected $casts = [
      'files' => 'array'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
