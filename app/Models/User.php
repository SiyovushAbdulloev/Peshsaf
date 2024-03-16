<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property string $name
 * @property int $position_id
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $is_limited
 * @property CarbonInterface $expired
 * @property int $warehouse_id
 * @property int $outlet_id
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    public const NO_LIMIT = 'no_limit';

    public const NOT_ACTIVE = 'not_active';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'position_id',
        'address',
        'email',
        'phone',
        'password',
        'is_limited',
        'expired',
        'warehouse_id',
        'outlet_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function getRoleAttribute(): \Spatie\Permission\Models\Role
    {
        return $this->roles->first();
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function statusText(): Attribute
    {
        return Attribute::make(
            get: function () {
              $isLimited = $this->is_limited;

              if (!$isLimited) {
                  return 'Нет ограничения';
              } else {
                  $until = Carbon::parse($this->expired);
                  if (!$until->isFuture()) {
                      return 'Не активен';
                  }
                  $until = $until->format('d.m.Y');
                  return "Активен до $until";
              }
            }
        );
    }
}
