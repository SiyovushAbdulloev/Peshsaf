<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query
            ->when($filters['q'] ?? null, function (Builder $query, $q) {
                $q = preg_replace('/\s+/', '%', $q);
                $q = sprintf('%%%s%%', $q);

                $query->whereRaw('CONCAT_WS(" ", name, phone) LIKE ?', $q);
            });
    }
}
