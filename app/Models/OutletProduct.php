<?php

namespace App\Models;

use App\Models\Dictionaries\Product as DicProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class OutletProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_id',
        'product_id',
        'origin_id',
        'origin_type',
    ];

    public function dicProduct(): HasOneThrough
    {
        return $this->hasOneThrough(DicProduct::class, Product::class, 'id', 'id', 'product_id', 'dic_product_id');
    }
}
