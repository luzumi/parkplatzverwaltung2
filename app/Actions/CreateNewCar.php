<?php

namespace App\Actions;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateNewCar extends Model
{
    /**
     * @param CarRequest $request
     * @param SetImageName $setImageName
     * @return Car
     */
    public function handle(CarRequest $request, SetImageName $setImageName): Car
    {
        return Car::updateOrCreate([
            'user_id' => Auth::id(),
            'sign' => $request->input('sign'),
            'manufacturer' => $request->input('manufacturer'),
            'model' => $request->input('model'),
            'color' => $request->input('color'),
            'image' => $setImageName->handle($request, $this),
            'status' => true,
        ]);
    }
}
