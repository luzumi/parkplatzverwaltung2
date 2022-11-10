<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\ParkingSpot;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkingSpotController extends Controller
{
    public function index(): Factory|View|Application
    {
        $viewData = [];
        $viewData["title"] = "Parkplatzverwaltung";
        $viewData["subtitle"] = "Parkplatzübersicht";
        $viewData["parking_spots"] = ParkingSpot::all();
        return view('parking_spots.index')->with("viewData", $viewData);
    }

    public function show($id): Factory|View|Application
    {
        $parking_spot = ParkingSpot::findOrFail($id);

        $viewData = [];

        $viewData["user"] = User::findOrFail(Auth::id());
        $viewData["title"] = "Parkplatzansicht";
        $viewData["subtitle"] = "Parkplatz Nr. " . $parking_spot->getNumber();
        $viewData["parking_spot"] = $parking_spot;

        $car = Car::with('user')->where('cars.user_id', Auth::id())->get();
        $viewData["cars"] = $car;

        return view('parking_spots.show')->with("viewData", $viewData);
    }

    public function storeIndex(Request $request): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';

        $selected_ps_number = substr($request->getRequestUri(), -1);
        $viewData['users'] = User::all()->where('id', Auth::id())->first();
        $parking_spot = ParkingSpot::all()->where('number', $selected_ps_number);
        $car = Car::all()->where('id', Auth::id());

        $viewData['parking_spot'] = $parking_spot;
        $viewData['cars'] = $car;

        $id = $car->first()->getAttribute('id');
        $ps_id = $parking_spot->first()->getAttribute('id');

        ParkingSpot::findOrFail($ps_id)->update([
            'user_id' => Auth::id(),
            'car_id' => $id,
        ]);
//        dd($parking_spot);
        return view('parking_spots.reserve.store_reserve')->with("viewData", $viewData);
    }


    public function store(Request $request)
    {
        ParkingSpot::validate($request);

        $parking_spot_id = $request->get('radio');

        $parking_spot_user = new ParkingSpot();
        $parking_spot_user->setId($parking_spot_id);
        $parking_spot_user->setUserId(Auth::id());
//        $parking_spot_user->setIsFree(false);
        $parking_spot_user->save();

        $viewData = [];
        $viewData['car'] = Car::all()->last();
        $viewData['parking_spot'] = ParkingSpot::findOrFail($parking_spot_id);
        $viewData['users'] = User::findOrFail(Auth::id());
//        return redirect()->route('user.show')->with('jsAlert', $parking_spot_user)->with("viewData", $viewData);
//        return view('user.show')->with("viewData", $viewData);
    }
}
