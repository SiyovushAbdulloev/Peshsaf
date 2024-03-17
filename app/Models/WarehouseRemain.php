<?php

namespace App\Models;

use App\Models\Dictionaries\Product as DicProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class WarehouseRemain extends Model
{
    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(DicProduct::class, 'dic_product_id');
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, WarehouseRemainProduct::class, 'product_id', 'id');
    }
}
