<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public static $cars =[
        ['id' => '1', 'sign' => 'IN A 6050','manufacturer'=> 'Audi', 'model' => 'A6', 'color' => 'blue', 'status' => 'true'],
        ['id' => '2', 'sign' => 'WOB NP 732','manufacturer'=> 'VW', 'model' => 'Polo', 'color' => 'red', 'status' => 'true'],
        ['id' => '3', 'sign' => 'GG GT 302','manufacturer'=> 'Opel', 'model' => 'Mantra', 'color' => 'Green', 'status' => 'true'],
        ['id' => '4', 'sign' => 'DA X 6568','manufacturer'=> 'Skoda', 'model' => 'Fabia', 'color' => 'Silver', 'status' => 'true'],
    ];

    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Parkplatzverwaltung';
        $viewData['subtitle'] = 'Fahrzeugübersicht';
        $viewData['cars'] = CarController::$cars;

        return view('cars.index')->with('viewData', $viewData);

    }

    public function show($id)
    {
        $viewData = [];
        $car = CarController::$cars[$id-1];
        $viewData['title'] = 'Reservierung: '.$car['sign'];
        $viewData['subtitle'] = 'Details von '.$car['sign'];
        $viewData['sign'] = $car['sign'];
        $viewData['car'] = $car;

        return view('cars.show')->with('viewData', $viewData);
    }
}
