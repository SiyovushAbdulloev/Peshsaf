<?php

namespace App\Models;

use App\StateMachines\StatusUtilization;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Utilization extends Model
{
    use HasFactory, HasStateMachines;

    protected $fillable = [
        'status',
        'date',
        'number',
        'client_id',
        'outlet_id',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public $stateMachines = [
        'status' => StatusUtilization::class
    ];

    protected static function booted(): void
    {
        static::deleting(function (Utilization $utilization): void {
            $utilization->products()->delete();
        });
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function products(): HasMany
    {
        return $this->hasMany(UtilizationProduct::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }
}
