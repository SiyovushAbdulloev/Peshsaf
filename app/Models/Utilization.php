<?php

namespace App\Models;

use App\StateMachines\StatusUtilization;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Utilization extends Model
{
    use HasFactory, HasStateMachines;

    const CLIENT = 'client';

    const OUTLET = 'outlet';

    protected $fillable = [
        'status',
        'date',
        'number',
        'client_id',
        'outlet_id',
        'type',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public $stateMachines = [
        'status' => StatusUtilization::class,
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

    public function returner(): Attribute
    {
        return Attribute::make(
            get: function () {
               return match ($this->type) {
                   self::OUTLET => $this->outlet->name,
                   self::CLIENT => $this->client->name,
               };
            }
        );
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query
            ->when($filters['from'] ?? null, function ($query, string $from) {
                $query->whereDate('created_at', '>=', Carbon::createFromDate($from));
            })
            ->when($filters['outlet'] ?? null, function ($query, string $outlet) {
                $query->where('outlet_id', (int)$outlet);
            })
            ->when($filters['to'] ?? null, function ($query, string $to) {
                $query->whereDate('created_at', '<=', Carbon::createFromDate($to));
            });
    }
}
