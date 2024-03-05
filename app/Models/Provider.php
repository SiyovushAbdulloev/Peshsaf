<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property string $organization_name
 * @property string $full_name
 * @property int $country_id
 * @property string $organization_address
 * @property string $phone
 * @property string $email
 * @property string $organization_info
 */
class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_name',
        'full_name',
        'country_id',
        'organization_address',
        'phone',
        'email',
        'organization_info',
    ];

    protected $casts = [
//      'files' => 'array'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
