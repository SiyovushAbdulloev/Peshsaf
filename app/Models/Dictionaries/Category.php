<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $code
 */
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'code'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
