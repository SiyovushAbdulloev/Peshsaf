<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property bool $is_favorite
 * @property string $code
 */
class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'is_favorite',
        'code',
    ];
}
