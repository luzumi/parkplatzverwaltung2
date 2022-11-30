<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static findOrFail($id)
 * @method static create(array $creationData)
 * @method static where(string $string, int|string|null $id)
 */
class Car extends Model
{
    protected $fillable = ['user_id', 'sign', 'manufacturer', 'model', 'color', 'image', 'status'];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id');
    }

    /**
     * @return HasOne
     */
    public function parkingSpot(): HasOne
    {
        return $this->hasOne(ParkingSpot::class);
    }
}
