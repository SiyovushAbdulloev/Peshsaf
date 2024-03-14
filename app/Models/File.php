<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'original_filename',
        'mimetype',
        'size',
        'fileable_type',
        'fileable_id',
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::url($this->filename),
        );
    }
}
