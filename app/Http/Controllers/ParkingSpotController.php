<?php

namespace App\Http\Controllers;

use App\Models\Address;
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

    public function show($parking_spot_id): Factory|View|Application
    {
        $parking_spot = ParkingSpot::findOrFail($parking_spot_id);
        $viewData = [];

        $viewData["user"] = User::findOrFail(Auth::id());
        $viewData["title"] = "Parkplatzansicht";
        $viewData["subtitle"] = "Parkplatz Nr. " . $parking_spot->getNumber();
        $viewData["parking_spot"] = $parking_spot;
//        $viewData['cars'] = Car::getCarWithParkingSpot()

        $car = Car::getCarWithParkingSpot(Auth::id());

        $viewData["cars"] = $car;

        return view('parking_spots.show')->with("viewData", $viewData);
    }

    public function storeIndex(Request $request): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';

        $offset = strripos($request->session()->previousUrl(), '/') + 1;
        $selected_ps_number = substr($request->session()->previousUrl(), $offset);

        $viewData['user'] = User::all()->where('id', Auth::id())->first();
        $parking_spot = ParkingSpot::all()->where('id', $selected_ps_number);
        $car = Car::all()->where('user_id', Auth::id());
        $car_id = $car->first()->id;
        $parking_spot_id = $parking_spot->first()->id;

        $viewData['parking_spot'] = $parking_spot;
        $viewData['cars'] = $car;

//        dd($request->session()->previousUrl() ,'storeIndex');
        ParkingSpot::updateParkingSpot($parking_spot_id, $car_id);

        return view('parking_spots.reserve.store_reserve')->with("viewData", $viewData);
    }


    public function store(Request $request): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';

        ParkingSpot::validate($request);

        $offset = strripos($request->session()->previousUrl(), '/') + 1;
        $car_id = substr($request->session()->previousUrl(), $offset);
        $parking_spot_id = $request->get('radio');

        $parking_spot = ParkingSpot::findOrFail($parking_spot_id);
        $parking_spot->setId($parking_spot_id);
        $parking_spot->setUserId(Auth::id());
        $parking_spot->setCarId($car_id);
        $parking_spot->setStatus('reserviert');
        $parking_spot->setImage('reserviert.jpg');
        $parking_spot->update();

        return view('user.show', [Auth::id()])->with("viewData", $viewData);
    }

    public function storeThisCar(Request $request): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';

        $viewData['user'] = User::all()->where('id', Auth::id())->first();
        $viewData['address'] = Address::all()->where('user_id', Auth::id())->first();

        $parking_spot_id = $request['status'];
        $parking_spot = ParkingSpot::findOrFail($parking_spot_id);

        $offset = strripos($request->session()->previousUrl(), '/') + 1;
        $car_id = substr($request->session()->previousUrl(), $offset);
        $parking_spot->setUserId(Auth::id());
        $parking_spot->setCarId($car_id);
        $parking_spot->setStatus('reserviert');
        $parking_spot->setImage('reserviert.jpg');
        $parking_spot->update();

        $car = Car::getCarWithParkingSpot(Auth::id());
        $viewData['cars'] = $car;

        return view('user.show', [Auth::id()])->with("viewData", $viewData);
    }

    public function cancel($ps_id): Application|Factory|View
    {
        ParkingSpot::resetParkingSpot();

        $viewData = [];
        $viewData["title"] = "Parkplatzansicht";
        $viewData["subtitle"] = "Parkplatz Nr. " . $ps_id;

        $viewData['user'] = User::findOrFail(Auth::id());
        $viewData['parking_spots'] = ParkingSpot::all();

        $viewData['cars'] = Car::getCarWithParkingSpot($ps_id);

        return view('parking_spots.index')->with("viewData", $viewData);
    }
}
