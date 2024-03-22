<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'type',
        'date',
        'warehouse_id',
        'client_id',
        'number',
    ];

    public function origin(): MorphTo
    {
        return $this->morphTo();
    }

    public function products(): HasMany
    {
        return $this->hasMany(RefundProduct::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
}
