<?php

namespace App\Models;

use App\StateMachines\StatusReceipt;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receipt extends Model
{
    use HasFactory, HasStateMachines;

    protected $fillable = [
        'status',
        'number',
        'date',
        'supplier_id',
        'warehouse_id'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public $stateMachines = [
        'status' => StatusReceipt::class
    ];

    public function products(): HasMany
    {
        return $this->hasMany(ReceiptProduct::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
