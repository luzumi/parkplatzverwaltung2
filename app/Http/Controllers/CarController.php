<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{

    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Parkplatzverwaltung';
        $viewData['subtitle'] = 'Fahrzeugübersicht';
        $viewData['cars'] = Car::all();

        return view('cars.index')->with('viewData', $viewData);

    }

    public function show($id)
    {
        $viewData = [];
        $car = Car::findOrFail($id);
        $viewData['title'] = 'Reservierung: '. $car->getSign();
        $viewData['subtitle'] = 'Details von '. $car->getSign();
        $viewData['sign'] = $car->getSign();
        $viewData['car'] = $car;

        return view('cars.show')->with('viewData', $viewData);
    }
}
