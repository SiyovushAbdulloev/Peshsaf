<?php

namespace App\Models;

use App\StateMachines\StatusReceipt;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receipt extends Model
{
    use HasFactory, HasStateMachines;

    protected $fillable = [
        'status',
        'number',
        'date',
        'supplier_id',
        'warehouse_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public $stateMachines = [
        'status' => StatusReceipt::class,
    ];

    protected static function booted(): void
    {
        static::deleting(function (Receipt $receipt): void {
            $receipt->products()->delete();
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(ReceiptProduct::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function scopeByStatus(Builder $query, array|string $statuses): void
    {
        if (!is_array($statuses)) {
            $statuses = [$statuses];
        }
        $query->whereIn('status', $statuses);
    }
}
