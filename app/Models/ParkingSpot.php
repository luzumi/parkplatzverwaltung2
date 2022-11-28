<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @method static findOrFail($id)
 * @method static create(array $creationData)
 * @method static where(string $string, string $selected_ps_number)
 */
class ParkingSpot extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'car_id', 'number', 'row', 'image', 'status'];

    /**
     * @param Request $request
     * @return void
     */
    public static function validate(Request $request)
    {
        $request->validate([
            "status" => "required",
        ]);
    }

    /**
     * @return bool
     */
    public static function resetParkingSpot(): bool
    {
        return ParkingSpot::where('user_id', Auth::id())->update([
            'user_id' => '1',
            'car_id' => null,
            'image' => 'frei.jpg',
            'status' => 'frei',
        ]);
    }

    /**
     * @param $parkingSpotId
     * @param $carId
     * @return void
     */
    public static function updateParkingSpot($parkingSpotId, $carId)
    {
        $parking_spot = ParkingSpot::findOrFail($parkingSpotId);
        $parking_spot->setId($parkingSpotId);
        $parking_spot->setCarId($carId);
        $parking_spot->setUserId(Auth::id());
        $parking_spot->setStatus('reserviert');
        $parking_spot->setImage('reserviert.jpg');
        $parking_spot->update();
    }

    /**
     * @return ParkingSpot[]|\LaravelIdea\Helper\App\Models\_IH_ParkingSpot_C
     */
    public static function getAllParkingSpotsWithCars()
    {
        return ParkingSpot::select(
            'parking_spots.id',
            'parking_spots.user_id',
            'parking_spots.user_id',
            'parking_spots.number',
            'parking_spots.row',
            'parking_spots.status',
            'cars.sign',
            'cars.image'
        )
            ->join('cars', 'parking_spots.car_id', '=', 'cars.id', 'left outer')
            ->get();
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
            'besetzt' => 'btn-outline-danger',
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


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'user_id' => '1'
        ]);
    }

    /**
     * @return HasOne
     */
    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }
}
