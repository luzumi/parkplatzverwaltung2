<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static get(string $string)
 */
class CarUser extends Model
{
    protected $fillable = ['user_id', 'car_id'];

    public static function validate($request)
    {
        $request->validate([
            "user_id" => "required|numeric",
            "car_id" => "required|numeric",
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

    public function getCarId()
    {
        return $this->attributes['car_id'];
    }

    public function setCarId($car_id)
    {
        $this->attributes['car_id'] = $car_id;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($created_at)
    {
        $this->attributes['created_at'] = $created_at;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser()
    {
        return $this->attributes['user'];
    }

    public function setUser($user)
    {
        $this->attributes['user'] = $user;
    }

    public function car(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Car::class);
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
