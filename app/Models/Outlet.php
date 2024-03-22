<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property string $name
 * @property string $address
 * @property string $phone
 */
class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function sales(): MorphMany
    {
        return $this->morphMany(Sale::class, 'model');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'outlet_id');
    }

    public function movements(): HasMany
    {
        return $this->hasMany(Movement::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(OutletProduct::class);
    }

    public function refunds(): MorphMany
    {
        return $this->morphMany(Refund::class, 'origin');
    }
}
