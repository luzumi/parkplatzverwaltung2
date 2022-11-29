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
    /**
     * @param $request
     * @return void
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

    /**
     * @param $user_id
     * @return Collection|array
     */
    public static function getCarWithParkingSpot($user_id): Collection|array
    {
        return Car::with('parkingSpot')
            ->where('cars.user_id', $user_id)->get();

//        return Car::with('parkingSpot')
//            ->select(
//                'cars.id',
//                'cars.sign',
//                'cars.image',
//                'cars.manufacturer',
//                'cars.model',
//                'cars.color'
//            )
//            ->where('cars.user_id', $user_id)
//            ->leftJoin('parking_spots', 'parking_spots.user_id', '=', 'cars.user_id')
//            ->distinct()
//            ->get();
    }

    /**
     * @return Collection|array
     */
    public static function getAllCarWithParkingSpot(): Collection|array
    {
        return Car::with('parkingSpot')->get();
//        return Car::with('parkingSpot')
//            ->select(
//                'cars.user_id',
//                'cars.id',
//                'cars.sign',
//                'cars.image',
//                'cars.manufacturer',
//                'cars.model',
//                'cars.color'
//            )
//            ->leftJoin('parking_spots', 'parking_spots.user_id', '=', 'cars.user_id')
//            ->distinct()
//            ->get();
    }
}
