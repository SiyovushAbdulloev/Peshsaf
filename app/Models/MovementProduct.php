<?php

namespace App\Models;

use App\Models\Dictionaries\Product as DicProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class MovementProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
    ];

    public function movement(): BelongsTo
    {
        return $this->belongsTo(Movement::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function dicProduct(): HasOneThrough
    {
        return $this->hasOneThrough(DicProduct::class, Product::class, 'id', 'id', 'product_id', 'dic_product_id');
    }
}
