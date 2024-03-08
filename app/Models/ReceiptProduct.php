<?php

namespace App\Models;

use App\Models\Dictionaries\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceiptProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'dic_product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'dic_product_id');
    }
}
