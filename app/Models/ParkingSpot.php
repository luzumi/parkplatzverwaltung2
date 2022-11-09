<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $creationData)
 * @method static findOrFail($id)
 */
class ParkingSpot extends Model
{
    /**
     * CAR ATTRIBUTES
     * $this->attributes['id'] - int - contains the parking_spot primary key
     * $this->attributes['number'] - string - contains the parking_spot number
     * $this->attributes['row'] - string - contains the parking_spot row
     * $this->attributes['image'] - string - contains the parking_spot image
     * $this->attributes['status'] - string - contains the parking_spot status
     * $this->attributes['created_at'] - timestamp - contains the parking_spot creation date
     * $this->attributes['updated_at'] - timestamp - contains the parking_spot updated date
     *
     */

    protected $fillable = ['number', 'row', 'image', 'status'];

    public static function validate(\Illuminate\Http\Request $request)
    {
        $request->validate([
            "status" => "required",
        ]);
    }

    /**
     * @return string CSS-Style
     */
    public function switchStatus(): string
    {
        return match ($this->getStatus()) {
            'frei', 'Behindertenparkplatz' => 'btn-success',
            'electro' => 'btn-info',
            'reserviert' => 'btn-warning',
            'besetzt' =>'btn-outline-danger',
            'gesperrt' => 'btn-danger',
            default => 'alert-dark ',
        };
    }

    public function getStatus()
    {
        return $this->attributes['status'];
    }

    /**
     * @return string ButtonText
     */
    public function getStatusMessage(): string
    {
        return match ($this->getStatus()) {
            'frei', 'electro', 'Behindertenparkplatz' => ' - derzeit frei',
            'reserviert', 'besetzt', 'gesperrt' => ' - Parken derzeit nicht möglich',
            default => ' !!! Parkplatzstatus ungültig! Informieren SIe einen Administrator !!!',
        };
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getNumber()
    {
        return $this->attributes['number'];
    }

    public function setNumber($number)
    {
        $this->attributes['number'] = $number;
    }

    public function getRow()
    {
        return $this->attributes['row'];
    }

    public function setRow($row)
    {
        $this->attributes['row'] = $row;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function setImage($image)
    {
        $this->attributes['image'] = $image;
    }

    public function setStatus($status)
    {
        $this->attributes['status'] = $status;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
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

    public function parkingSpotUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarUser::class);
    }

    public function getParkingSpotUser()
    {
        return $this->attributes['parkingSpotUser'];
    }

    public function setParkingSpotUser($parkingSpotUser)
    {
        $this->attributes['parkingSpotUser'] = $parkingSpotUser;
    }
}
