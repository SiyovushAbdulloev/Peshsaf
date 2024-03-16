<?php

namespace App\Models;

use App\Models\Dictionaries\Product as DicProduct;
use App\StateMachines\StatusSale;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'status' => StatusSale::class,
    ];

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
        return Product::create([
            'dic_product_id' => $this->dic_product_id,
            'model_type'     => $this->model_type,
            'model_id'       => $this->model_id,
            'barcode'        => $this->barcode,
            'history'        => $this->history,
        ]);
    }
}
