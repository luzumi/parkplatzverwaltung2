<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarUser;
use App\Models\ParkingSpot;
use App\Models\ParkingSpotUser;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkingSpotUserController extends Controller
{
    public function index(Request $request): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';
        $viewData['subtitle'] = 'Reserve a parking spot - Parkplatzverwaltung';

        $viewData['users'] = User::all()->where('id', Auth::id())->first();
        $viewData['parking_spot'] = ParkingSpot::all('number');
        $viewData['cars'] = Car::all();


        $parking_spot_user = new ParkingSpot();
        $parking_spot_user->setId( $request['radio'] );
        $parking_spot_user->setUserId(Auth::id());
//        $parking_spot_user->setIsFree(false);
        $parking_spot_user->save();
//        $this->store($request);
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
