<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelIdea\Helper\App\Models\_IH_ParkingSpot_C;

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
     * @return bool
     */
    public static function resetParkingSpot(): bool
    {
        return ParkingSpot::where('user_id', Auth::id())->update([
            'user_id' => '1',
            'car_id' => null,
            'status' => 'frei',
            'image' => 'frei.jpg',
        ]);
    }

    /**
     * @param $parkingSpotId
     * @param $carId
     * @return bool
     */
    public static function updateParkingSpot($parkingSpotId, $carId): bool
    {
        return ParkingSpot::findOrFail($parkingSpotId)->update([
            'user_id' => $parkingSpotId,
            'car_id' => $carId,
            'status' => 'reserviert',
            'image' => 'reserviert.jpg',
        ]);
    }

    /**
     * @return ParkingSpot[]|_IH_ParkingSpot_C
     */
    public static function getAllParkingSpotsWithCars(): array|_IH_ParkingSpot_C
    {
        return ParkingSpot::with('cars')->get();
//        return ParkingSpot::select(
//            'parking_spots.id',
//            'parking_spots.user_id',
//            'parking_spots.user_id',
//            'parking_spots.number',
//            'parking_spots.row',
//            'parking_spots.status',
//            'cars.sign',
//            'cars.image'
//        )
//            ->join('cars', 'parking_spots.car_id', '=', 'cars.id', 'left outer')
//            ->get();
    }

    /**
     * switch the CSS-Style for Buttons
     * @return string CSS-Style
     */
    public function switchStatus(): string
    {
        return match ($this->status) {
            'frei', 'Behindertenparkplatz' => 'btn-success',
            'electro' => 'btn-info',
            'reserviert' => 'btn-warning',
            'besetzt' => 'btn-outline-danger',
            'gesperrt' => 'btn-danger',
            default => 'alert-dark ',
        };
    }

    /**
     * switch the Output for ButtonText
     * @return string ButtonText
     */
    public function getStatusMessage(): string
    {
        return match ($this->status) {
            'frei', 'electro', 'Behindertenparkplatz' => ' - derzeit frei',
            'reserviert', 'besetzt', 'gesperrt' =>  $this->status . ' - Reservierung nicht möglich',
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
