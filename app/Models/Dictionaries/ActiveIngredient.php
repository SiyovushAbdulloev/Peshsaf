<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 */
class ActiveIngredient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];
}
