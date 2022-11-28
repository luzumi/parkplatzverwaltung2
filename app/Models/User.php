<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static findOrFail(int|string|null $id)
 * @method static create(array $creationData)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $name;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public static function validate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'email:rfc,dns|required|max:50'
        ]);
    }


    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'user_id', 'id')->withDefault([
            'status' => true,
            'image' => 'testCar.png',
        ]);
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    public function parkingSpot(): HasMany
    {
        return $this->hasMany(ParkingSpot::class);
    }

    public function parkingSpots(): BelongsToMany
    {
        return $this->belongsToMany(ParkingSpot::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function hasRole($roleName): bool
    {
        return $this->role == $roleName;
    }
}
