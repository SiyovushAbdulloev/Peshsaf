<?php

namespace App\Models;

use App\Models\Dictionaries\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $organization_name
 * @property string $full_name
 * @property int $country_id
 * @property string $organization_address
 * @property string $phone
 * @property string $email
 * @property string $description
 * @property string $code
 */
class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_name',
        'full_name',
        'country_id',
        'organization_address',
        'phone',
        'email',
        'description',
        'code',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Supplier $supplier) {
            foreach ($supplier->files as $file) {
                if (Storage::exists($file)) {
                    Storage::delete($file);
                }
            }

            $supplier->files()->delete();
        });
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
