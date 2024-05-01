<?php

namespace App\Models;

use App\Models\Dictionaries\Product as DicProduct;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutletProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'outlet_id',
        'product_id',
        'model_type',
        'model_id',
    ];

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function dicProduct(): HasOneThrough
    {
        return $this->hasOneThrough(DicProduct::class, Product::class, 'id', 'id', 'product_id', 'dic_product_id')
            ->withTrashed();
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query
            ->when($filters['warehouse'] ?? null, function ($query, int $warehouse) {
                $query
                    ->where('model_type', Warehouse::class)
                    ->where('model_id', $warehouse);
            })
            ->when($filters['outlet'] ?? null, function ($query, int $outlet) {
                $query
                    ->where('model_type', Outlet::class)
                    ->where('model_id', $outlet);
            })
            ->when($filters['from'] ?? null, function ($query, string $from) {
                $query->whereDate('outlet_products.created_at', '>=', Carbon::createFromDate($from));
            })
            ->when($filters['to'] ?? null, function ($query, string $to) {
                $query->whereDate('outlet_products.created_at', '<=', Carbon::createFromDate($to));
            });
    }
}
