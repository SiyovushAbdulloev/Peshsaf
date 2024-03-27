<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function movements(): HasMany
    {
        return $this->hasMany(Movement::class);
    }

    public function utilizations(): MorphMany
    {
        return $this->morphMany(Utilization::class, 'model');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'warehouse_id');
    }

    public function returns(): HasMany
    {
        return $this->hasMany(Refund::class);
    }

    public function remainProducts(): HasManyThrough
    {
        return $this->hasManyThrough(WarehouseRemainProduct::class, WarehouseRemain::class,  'warehouse_id', 'warehouse_remain_id', 'id', 'id',);
    }
}
