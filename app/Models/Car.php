<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $creationData)
 * @method static findOrFail($id)
 */
class Car extends Model
{
    /**
     * CAR ATTRIBUTES
     * $this->attributes['id'] - int - contains the car primary key
     * $this->attributes['sign'] - string - contains the car sign
     * $this->attributes['manufacturer'] - string - contains the car manufacturer
     * $this->attributes['model'] - string - contains the car model
     * $this->attributes['color'] - string - contains the car color
     * $this->attributes['status'] - string - contains the car status
     * $this->attributes['created_at'] - timestamp - contains the car creation date
     * $this->attributes['updated_at'] - timestamp - contains the car updated date
     *
     */
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

    protected $fillable = ['sign', 'manufacturer', 'model', 'color', 'image', 'status'];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
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

    public function carUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarUser::class);
    }

    public function getCarUser()
    {
        return $this->attributes['carUser'];
    }

    public function setCarUser($carUser)
    {
        $this->attributes['carUser'] = $carUser;
    }

}
