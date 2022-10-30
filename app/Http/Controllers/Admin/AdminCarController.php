<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class AdminCarController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Panel - Fahrzeugübersicht - Parkplatzverwaltung';
        $viewData['cars'] = Car::all();

        return view('admin.car.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $request->validate([
            "sign" => "required|max:12",
            'manufacturer' => "required",
            "model" => "required",
            "color" => "required",
//            "image" => "image",
        ]);

//        $newCar = new Car();
//        $newCar -> setSign($request->input('sign'));
//        $newCar -> setManufacturer($request->input('manufacturer'));
//        $newCar -> setModel($request->input('model'));
//        $newCar -> setColor($request->input('color'));
//        $newCar -> setImage($request->input('testCar.png'));
//        $newCar -> setStatus(true);
//        $newCar -> save();

        $creationData = $request->only(['sign', 'manufacturer', 'model', 'color']);
        $creationData['status'] = true;
        $creationData['image'] = 'testCar.png';
        Car::create($creationData);

        return back();
    }
}
