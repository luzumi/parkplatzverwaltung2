<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static findOrFail($id)
 * @method static create(array $creationData)
 * @method static where(string $string, int|string|null $id)
 */
class Car extends Model
{
    public static function validate($request)
    {
        $request->validate([
            "sign" => "required|max:12",
            'manufacturer' => "required",
            "model" => "required",
            "color" => "required",
            "image" => "image",
        ]);
    }

    protected $fillable = ['user_id', 'sign', 'manufacturer', 'model', 'color', 'image', 'status'];


    //Getter/Setter
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

    public function setUserId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function getSign()
    {
        return $this->attributes['sign'];
    }

    public function setSign($sign)
    {
        $this->attributes['sign'] = $sign;
    }

    public function getManufacturer()
    {
        return $this->attributes['manufacturer'];
    }

    public function setManufacturer($manufacturer)
    {
        $this->attributes['manufacturer'] = $manufacturer;
    }

    public function getModel()
    {
        return $this->attributes['model'];
    }

    public function setModel($model)
    {
        $this->attributes['model'] = $model;
    }

    public function getColor()
    {
        return $this->attributes['color'];
    }

    public function setColor($color)
    {
        $this->attributes['color'] = $color;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function setImage($image)
    {
        $this->attributes['image'] = $image;
    }

    public function getStatus()
    {
        return $this->attributes['status'];
    }

    public function setStatus($status)
    {
        $this->attributes['status'] = $status;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($value)
    {
        $this->attributes['created_at'] = $value;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($value)
    {
        $this->attributes['updated_at'] = $value;
    }

    public function getUser()
    {
        return $this->attributes['user'];
    }

    public function setUser($user)
    {
        $this->attributes['user'] = $user;
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id');
    }

    public function parkingSpot(): HasOne
    {
        return $this->hasOne(ParkingSpot::class);
    }

}
