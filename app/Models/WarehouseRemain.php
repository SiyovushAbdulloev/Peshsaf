<?php

namespace App\Models;

use App\Models\Dictionaries\Product as DicProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WarehouseRemain extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'dic_product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(DicProduct::class, 'dic_product_id')->withTrashed();
    }

    public function products(): HasMany
    {
        return $this->hasMany(WarehouseRemainProduct::class);
    }
}
