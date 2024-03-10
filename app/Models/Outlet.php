<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $address
 * @property string $phone
 */
class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];
}
