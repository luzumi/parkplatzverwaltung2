<?php
namespace App\Actions\Admin;

use App\Actions\SetImageName;
use App\Http\Requests\CarRequest;
use App\Models\Car;

class UpdateCar
{
    public function handle(CarRequest $request, SetImageName $setImageName, int $car_id): bool
    {
        $car = Car::findOrFail($car_id);
        return $car->update([
            'sign' =>  $request->input('sign'),
            'manufacturer' =>  $request->input('manufacturer'),
            'model' =>  $request->input('model'),
            'color' =>  $request->input('color'),
            'image' => $setImageName->handle($request, $car),
        ]);
    }
}
