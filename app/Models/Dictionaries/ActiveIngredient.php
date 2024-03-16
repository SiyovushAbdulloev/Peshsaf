<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 */
class ActiveIngredient extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
