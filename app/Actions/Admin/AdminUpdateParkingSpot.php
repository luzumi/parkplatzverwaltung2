<?php

namespace App\Actions\Admin;

use App\Actions\SetImageName;
use App\Http\Requests\ParkingSpotRequest;
use App\Models\Car;
use App\Models\ParkingSpot;

class AdminUpdateParkingSpot
{
    /**
     * @param ParkingSpotRequest $request
     * @param SetImageName $setImageName
     * @param int $parking_spot_id
     * @return bool
     */
    public function handle(ParkingSpotRequest $request, SetImageName $setImageName, int $parking_spot_id): bool
    {
        $car = ParkingSpot::findOrFail($parking_spot_id);
        return $car->update([
            'status' => $request->input('status'),
            'image' => $request->input('image'),
        ]);
    }
}
