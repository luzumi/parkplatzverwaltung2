<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingSpotRequest;
use App\Models\Address;
use App\Models\Car;
use App\Models\ParkingSpot;
use App\Models\User;
use App\Services\ParkingSpotService;
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
        $viewData["subtitle"] = "Parkplatz Nr. " . $parking_spot->number;
        $viewData["parking_spot"] = $parking_spot;
        $viewData["cars"] = Car::getCarWithParkingSpot(Auth::id());

        return view('parking_spots.show')->with("viewData", $viewData);
    }

    public function storeIndex(ParkingSpotRequest $request): Factory|View|Application
    {
        ParkingSpotService::update($request);

        $user = User::findOrFail(Auth::id())->first();
        $viewData = [];
        $viewData['title'] = $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['user'] = $user;
        $viewData['parking_spot'] = $user->with('parkingSpot');
        $viewData['cars'] = $user->with('car');

        return view('parking_spots.reserve.store_reserve')->with("viewData", $viewData);
    }


    public function store(ParkingSpotRequest $request): Factory|View|Application
    {
        ParkingSpotService::update($request);

        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';

        return view('user.show', [Auth::id()])->with("viewData", $viewData);
    }

    public function storeThisCar(ParkingSpotRequest $request): Factory|View|Application
    {
        ParkingSpotService::update($request);

        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['user'] = User::findOrFail(Auth::id());
        $viewData['address'] = Address::where('user_id', Auth::id())->first();
        $viewData['cars'] = Car::with('parkingSpot')->where('user_id', Auth::id())->get();

        return view('user.show', [Auth::id()])->with("viewData", $viewData);
    }

    public function cancel($ps_id): Application|Factory|View
    {
        ParkingSpotService::resetParkingSpot($ps_id);

        $viewData = [];
        $viewData["title"] = "Parkplatzansicht";
        $viewData["subtitle"] = "Parkplatz Nr. " . $ps_id;
        $viewData['user'] = User::findOrFail(Auth::id());
        $viewData['parking_spots'] = ParkingSpot::all();
        $viewData['cars'] = Car::getCarWithParkingSpot($ps_id);

        return view('parking_spots.index')->with("viewData", $viewData);
    }
}
