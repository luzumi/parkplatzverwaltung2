<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Car;
use App\Models\ParkingSpot;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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

        $car = Car::with('parkingSpot')
            ->select(
                'cars.id',
                'cars.sign',
                'cars.image',
                'cars.manufacturer',
                'cars.model',
                'cars.color',
                'parking_spots.number'
            )
            ->where('cars.user_id', Auth::id())
            ->join('parking_spots', 'parking_spots.user_id', '=', 'cars.user_id')
            ->distinct()
            ->get();
//        dd($viewData);

        $viewData["cars"] = $car;
        return view('parking_spots.show')->with("viewData", $viewData);
    }

    public function storeIndex(Request $request): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';

        $selected_ps_number = substr($request->getRequestUri(), -1);

        $viewData['user'] = User::all()->where('id', Auth::id())->first();
        $parking_spot = ParkingSpot::all()->where('number', $selected_ps_number);
        $car = Car::all()->where('user_id', Auth::id());
        $viewData['parking_spot'] = $parking_spot;
        $viewData['cars'] = $car;

        $id = $car->first()->getAttribute('id');
        $ps_id = $parking_spot->first()->getAttribute('id');

        ParkingSpot::findOrFail($ps_id)->update([
            'user_id' => Auth::id(),
            'car_id' => $id,
            'image' => 'reserviert.jpg',
            'status' => 'reserviert'
        ]);

        return view('parking_spots.reserve.store_reserve')->with("viewData", $viewData);
    }


    public function store(Request $request): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';

        ParkingSpot::validate($request);

        $parking_spot_id = $request->get('radio');

        $parking_spot_user = ParkingSpot::findOrFail($parking_spot_id);
        $parking_spot_user->setId($parking_spot_id);
        $parking_spot_user->setUserId(Auth::id());
        $parking_spot_user->setStatus('reserviert');
        $parking_spot_user->setImage('reserviert.jpg');
        $parking_spot_user->update();

        return view('user.show', [Auth::id()])->with("viewData", $viewData);
    }

    public function storeThisCar(Request $request): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['user'] = User::all()->where('id', Auth::id())->first();
        $viewData['address'] = Address::all()->where('id', Auth::id())->first();

        $parking_spot_id = $request['status'];
        $parking_spot_user = ParkingSpot::findOrFail($parking_spot_id);
        $parking_spot_user->setId($parking_spot_id);

        $parking_spot_user->setUserId(Auth::id());

        $offset = strripos($request->session()->previousUrl(), '/') + 1;
        $parking_spot_user->setCarId(substr($request->session()->previousUrl(), $offset));

        $parking_spot_user->setStatus('reserviert');
        $parking_spot_user->setImage('reserviert.jpg');


        $car = Car::with('parkingSpot')
            ->select(
                'cars.id',
                'cars.sign',
                'cars.image',
                'cars.manufacturer',
                'cars.model',
                'cars.color'
            )
            ->where('cars.user_id', Auth::id())
            ->join('parking_spots', 'parking_spots.user_id', '=', 'cars.user_id')
            ->distinct()
            ->get();

        $viewData['cars'] = $car;
        $parking_spot_user->update();

        return view('user.show', [Auth::id()])->with("viewData", $viewData);
    }

    public function cancel($ps_id): Application|Factory|View
    {
        $parking_spot = ParkingSpot::where('id', $ps_id)->first();

        $parking_spot->setUserId('1');
        $parking_spot->setCarId(null);
        $parking_spot->setImage('frei.jpg');
        $parking_spot->setStatus('frei');
        $parking_spot->save();

        $viewData = [];
        $viewData["title"] = "Parkplatzansicht";
        $viewData["subtitle"] = "Parkplatz Nr. " . $ps_id;

        $viewData['user'] = User::findOrFail(Auth::id());
        $viewData['parking_spot'] = ParkingSpot::findOrFail($ps_id);

        $viewData['cars'] = Car::with('parkingSpot')
            ->select(
                'cars.id',
                'cars.sign',
                'cars.image',
                'cars.manufacturer',
                'cars.model',
                'cars.color'
            )
            ->where('cars.user_id', Auth::id())
            ->join('parking_spots', 'parking_spots.user_id', '=', 'cars.user_id')
            ->distinct()
            ->get();

        return view('parking_spots.show')->with("viewData", $viewData);
    }
}
