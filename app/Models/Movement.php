<?php

namespace App\Models;

use App\StateMachines\StatusMovement;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeByStatus(Builder $query, array|string $statuses): void
    {
        if (!is_array($statuses)) {
            $statuses = [$statuses];
        }
        $query->whereIn('status', $statuses);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query
            ->when($filters['warehouse'] ?? null, function ($query, int $warehouse) {
                $query->where('warehouse_id', $warehouse);
            })
            ->when($filters['from'] ?? null, function ($query, string $from) {
                $query->whereDate('date', '>=', Carbon::createFromDate($from));
            })
            ->when($filters['to'] ?? null, function ($query, string $to) {
                $query->whereDate('date', '<=', Carbon::createFromDate($to));
            });
    }
}
