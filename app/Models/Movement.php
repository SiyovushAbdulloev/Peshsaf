<?php

namespace App\Models;

use App\StateMachines\StatusMovement;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movement extends Model
{
    use HasFactory, HasStateMachines;

    protected $fillable = [
        'status',
        'date',
        'number',
        'warehouse_id',
        'outlet_id',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public $stateMachines = [
        'status' => StatusMovement::class
    ];

    protected static function booted(): void
    {
        static::deleting(function (Movement $movement): void {
            $movement->products()->delete();
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(MovementProduct::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }
}
