<?php

namespace App\Services;


use App\Http\Requests\ParkingSpotRequest;
use App\Models\ParkingSpot;
use Illuminate\Support\Facades\Auth;

class ParkingSpotService
{
    /**
     * @param ParkingSpotRequest $request
     * @return void
     */
    public static function update(ParkingSpotRequest $request): void
    {
        $offset = strripos($request->session()->previousUrl(), '/') + 1;
        $car_id = substr($request->session()->previousUrl(), $offset);
        $parking_spot_id = $request->get('radio')??$request->get('status');

        ParkingSpot::findOrFail($parking_spot_id)->update([
            'user_id' => Auth::id(),
            'car_id' => $car_id,
            'status' => 'reserviert',
            'image' => 'reserviert.jpg',
        ]);
    }

    /**
     * @param $ps_id
     * @return bool
     */
    public static function resetParkingSpot($ps_id): bool
    {
        return ParkingSpot::where('id', $ps_id)->update([
            'user_id' => '1',
            'car_id' => null,
            'status' => 'frei',
            'image' => 'frei.jpg',
        ]);
    }
}
