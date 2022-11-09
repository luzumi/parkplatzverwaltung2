<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $userSpot)
 */
class ParkingSpotUser extends Model
{
    protected $fillable = ['user_id', 'parking_spot_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function validate($request)
    {
        $request->validate([
            "user_id" => "required|numeric",
            "parking_spot_id" => "required|numeric",
        ]);
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($id)
    {
        $this->attributes['user_id'] = $id;
    }

    public function getIsFree()
    {
        return $this->attributes['isFree'];
    }

    public function setIsFree($isFree)
    {
        $this->attributes['isFree'] = $isFree;
    }

    public function getParkingSpotId()
    {
        return $this->attributes['parking_spot_id'];
    }

    public function setParkingSpotId($car_id)
    {
        $this->attributes['parking_spot_id'] = $car_id;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($created_at)
    {
        $this->attributes['created_at'] = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updated_at)
    {
        $this->attributes['updated_at'] = $updated_at;
    }

    public function parkingSpot()
    {
        return $this->hasOne(ParkingSpot::class);
    }

    public function getParkingSpot()
    {
        return $this->parkingSpot;
    }

    public function setParkingSpot($parkingSpot)
    {
        $this->parkingSpot = $parkingSpot;
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getUser()
    {
        return $this->attributes['user'];
    }

    public function setUser($user)
    {
        $this->attributes['user'] = $user;
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }

    public function getCar()
    {
        return $this->attributes['car'];
    }

    public function setCar($car)
    {
        $this->attributes['car'] = $car;
    }
}
