<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property string $name
 * @property string $address
 * @property string $phone
 */
class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function receipts(): HasMany
    {
        return $this->hasMany(Receipt::class);
    }

    public function sales(): MorphMany
    {
        return $this->morphMany(Sale::class, 'model');
    }
}
