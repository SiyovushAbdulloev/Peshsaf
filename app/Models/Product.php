<?php

namespace App\Models;

use App\Models\Dictionaries\Product as DicProduct;
use App\StateMachines\StatusProduct;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Product extends Model
{
    use HasFactory, HasStateMachines;

    protected $fillable = [
        'dic_product_id',
        'model_type',
        'model_id',
        'barcode',
        'history',
    ];

    public $stateMachines = [
        'status' => StatusProduct::class,
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(DicProduct::class, 'dic_product_id');
    }

    public function scopeByStatus(Builder $query, string|array $statuses): void
    {
        $query->whereIn('status', !is_array($statuses) ? [$statuses] : $statuses);
    }

    public function duplicate(): Product
    {
        $product = $this->replicate();
        $product->save();

        return $product;
    }
}
