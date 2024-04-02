<?php

namespace App\Models\Dictionaries;

use App\Models\File;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $status
 * @property int $category_id
 * @property int $active_ingredient_id
 * @property int $measure_id
 * @property int $country_id
 * @property int $barcode
 * @property CarbonInterface $expiry_date
 * @property string $description
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dic_products';

    protected $fillable = [
        'name',
        'status',
        'category_id',
        'active_ingredient_id',
        'measure_id',
        'country_id',
        'barcode',
        'expiry_date',
        'description',
    ];

    public function measure(): BelongsTo
    {
        return $this->belongsTo(Measure::class)->withTrashed();
    }

    public function activeIngredient(): BelongsTo
    {
        return $this->belongsTo(ActiveIngredient::class)->withTrashed();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class)->withTrashed();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
