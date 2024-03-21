<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'type',
        'date',
        'outlet_id',
        'number',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(RefundProduct::class);
    }
}
