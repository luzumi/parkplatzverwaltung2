<?php

namespace App\Http\Controllers;

use App\Models\ParkingSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParkingSpotController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Parkplatzverwaltung";
        $viewData["subtitle"] =  "Parkplatzübersicht";
        $viewData["parking_spots"] = ParkingSpot::all();
        return view('parking_spots.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $parking_spot = ParkingSpot::findOrFail($id);
        $viewData["user"] = \App\Models\User::findOrFail(Auth::id());
        $viewData["title"] = "Parkplatzansicht";
        $viewData["subtitle"] =  "Parkplatz Nr. " . $parking_spot->getNumber();
        $viewData["parking_spot"] = $parking_spot;
        $viewData["cars"] = DB::table('cars')
        ->select()
        ->join('car_users', 'cars.id' , '=', 'car_users.car_id')
        ->where('car_users.user_id', Auth::id())
        ->get();
        return view('parking_spots.show')->with("viewData", $viewData);
    }

    public function reserve()
    {
        $viewData = [];
        $viewData["title"] = "Parkplatz-Reservierung";
        $viewData['parking_spot'] = ParkingSpot::findOrFail(0);
        $viewData["subtitle"] =  "Reservierung für Parkplatz Nr. " . $viewData['parking_spot']->number;

        $viewData["user"] = \App\Models\User::findOrFail(Auth::id());
        $viewData["cars"] = DB::table('cars')
            ->select()
            ->join('car_users', 'cars.id' , '=', 'car_users.car_id')
            ->where('car_users.user_id', Auth::id())
            ->get();

        return view( 'parking_spots.reserve.store')->with("viewData", $viewData);
    }
}
