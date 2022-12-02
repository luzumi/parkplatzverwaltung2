<?php

namespace App\Actions\Admin;

use App\Http\Requests\ParkingSpotRequest;
use App\Models\ParkingSpot;

class AdminCreateNewParkingSpot
{
    /**
     * @param ParkingSpotRequest $request
     * @return ParkingSpot
     */
    public function handle(ParkingSpotRequest $request ): ParkingSpot
    {
        $count = ParkingSpot::count() + 1;

        return ParkingSpot::create([
            'user_id' => 1,
            'number' => $count,
            'row' => intdiv($count - 1, 4) + 1,
            'image' => $request->input('status') . '.jpg'
        ]);
    }
}
