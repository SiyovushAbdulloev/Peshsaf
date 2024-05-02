<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'link',
        'read_at',
    ];

    public function markAsRead(): bool
    {
        return $this->update(['read_at' => now()]);
    }
}
