<?php

namespace App\Models;

use App\Models\Dictionaries\Product as DicProduct;
use App\StateMachines\StatusProduct;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function lastActive(): HasOne
    {
        return $this->hasOne(Product::class, 'barcode', 'barcode')->active()->latest();
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(DicProduct::class, 'dic_product_id')->withTrashed();
    }

    public function scopeByStatus(Builder $query, string|array $statuses): void
    {
        $query->whereIn('status', !is_array($statuses) ? [$statuses] : $statuses);
    }

    public function scopeActive(Builder $query): void
    {
        $query
            ->where('status', '!=', 'approved')
            ->where('history', false);
    }

    public static function getLastProduct(): ?Product
    {
        return Product::firstWhere('barcode', Product::max('barcode'));
    }

    public function sender(): Attribute
    {
        $type = 'Торговая точка';
        return Attribute::make(
            get: function () use ($type) {
                if ($this->model instanceof Client) {
                    $type = 'Клиент';
                }

                return join(' / ', [$type, $this->model->name]);
            }
        );
    }
}
