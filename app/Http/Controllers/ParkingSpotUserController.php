<?php

namespace App\Http\Controllers;

use App\Models\ParkingSpotUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParkingSpotUserController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Reserve a parking spot - Parkplatzverwaltung';

        $viewData['users'] = User::all()->where('id', Auth::id());

        $viewData['cars'] = DB::table('cars')
            ->select()
            ->join('car_users', 'cars.id', '=', 'car_users.car_id')
            ->where('car_users.user_id', Auth::id())
            ->get();

        $viewData['parking_spots'] = DB::table('parking_spots')
            ->select()
            ->join('parking_spot_user', 'parking_spot_user.parking_spot_id', '=', 'parking_spots.id')
            ->where('parking_spot_user.user_id', Auth::id())
            ->get();

        return view('user.parking_spots/reserve/store_reserve')->with("viewData", $viewData);
    }


    public function store(Request $request)
    {
        ParkingSpotUser::validate($request);

        $parking_spot_id = $request->get('radio');

        $parking_spot_user = new ParkingSpotUser();
        $parking_spot_user->setParkingSpotId($parking_spot_id);
        $parking_spot_user->setUserId(User::findOrFail(Auth::id()));
        $parking_spot_user->setIsFree(true);
        $parking_spot_user->setCreatedAt(now());
        $parking_spot_user->setupdatedAt(now());
        $parking_spot_user->save();

        return view('parking_spot.reserve', $parking_spot_id);
    }
}
