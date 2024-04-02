<?php

namespace App\Models;

use App\StateMachines\StatusReceipt;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Receipt extends Model
{
    use HasFactory, HasStateMachines;

    protected $fillable = [
        'status',
        'number',
        'date',
        'supplier_id',
        'warehouse_id',
        'filepath',
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

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->filepath)
        );
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
            ->when($filters['from'] ?? null, function ($query, string $from) {
                $query->whereDate('receipts.created_at', '>=', Carbon::createFromDate($from));
            })
            ->when($filters['to'] ?? null, function ($query, string $to) {
                $query->whereDate('receipts.created_at', '<=', Carbon::createFromDate($to));
            });
    }
}
