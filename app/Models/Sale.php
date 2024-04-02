<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'client_id',
        'client_name',
        'client_address',
        'client_phone',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(SaleProduct::class);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query
            ->when($filters['phone'] ?? null, function ($query, string $phone) {
                $query->where('client_phone', $phone);
            })
            ->when($filters['from'] ?? null, function ($query, string $from) {
                $query->whereDate('date', '>=', Carbon::createFromDate($from));
            })
            ->when($filters['to'] ?? null, function ($query, string $to) {
                $query->whereDate('date', '<=', Carbon::createFromDate($to));
            });
    }
}
