<?php

namespace App\Models;

use App\Models\Dictionaries\Product as DicProduct;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutletProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'outlet_id',
        'product_id',
        'warehouse_id',
    ];

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
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
                $query->where('warehouse_id', $warehouse);
            })
            ->when($filters['from'] ?? null, function ($query, string $from) {
                $query->whereDate('outlet_products.created_at', '>=', Carbon::createFromDate($from));
            })
            ->when($filters['to'] ?? null, function ($query, string $to) {
                $query->whereDate('outlet_products.created_at', '<=', Carbon::createFromDate($to));
            });
    }
}
