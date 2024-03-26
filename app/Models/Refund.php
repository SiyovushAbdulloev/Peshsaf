<?php

namespace App\Models;

use App\StateMachines\StatusReturn;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Refund extends Model
{
    use HasFactory, HasStateMachines;

    const WAREHOUSE = 'warehouse';

    const CLIENT = 'client';

    protected $fillable = [
        'status',
        'type',
        'date',
        'warehouse_id',
        'client_id',
        'number',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public $stateMachines = [
        'status' => StatusReturn::class
    ];

    public function origin(): MorphTo
    {
        return $this->morphTo();
    }

    public function products(): HasMany
    {
        return $this->hasMany(RefundProduct::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    public function scopeByStatus(Builder $query, string|array $statuses): void
    {
        $query->whereIn('status', !is_array($statuses) ? [$statuses] : $statuses);
    }
}
