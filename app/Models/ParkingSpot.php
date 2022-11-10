<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * @method static findOrFail($id)
 * @method static create(array $creationData)
 * @method static where(string $string, string $selected_ps_number)
 */
class ParkingSpot extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'car_id', 'number', 'row', 'image', 'status'];

    public static function validate(Request $request)
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

    public function getCarId()
    {
        return $this->attributes['car_id'];
    }

    public function setCarId($car_id)
    {
        $this->attributes['car_id'] = $car_id;
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

    public function getStatus()
    {
        return $this->attributes['status'];
    }

    public function setStatus($status)
    {
        $this->attributes['status'] = $status;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($value)
    {
        $this->attributes['updated_at'] = $value;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'user_id' => '1'
        ]);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
