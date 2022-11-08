<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(): Factory|View|Application
    {
        $viewData = [];
        $viewData["title"] = "Parkplatzverwaltung";
        $viewData["subtitle"] = "User-Übersicht";
        $viewData["users"] = User::all();
        return view('user.index')->with("viewData", $viewData);
    }

    public function show(): Factory|View|Application
    {
        $viewData = [];
        $user = User::findOrFail(Auth::id());
        $viewData["title"] = $user["name"] . " - Parkplatzverwaltung";
        $viewData["subtitle"] = $user["name"] . " - User information";
        $viewData["user"] = $user;

        $reserved_parking_spots = DB::table('parking_spot_users')
            ->select('parking_spot_id')
            ->where('user_id', Auth::id())
            ->where('parking_spot_id', '=', 1)
            ->get();

        $viewData['cars'] = DB::table('cars')
            ->select()
            ->join('car_users', 'cars.id', '=', 'car_users.car_id')
            ->where('car_users.user_id', Auth::id())
            ->join('parking_spot_users', 'car_users.user_id', '=', 'parking_spot_users.user_id')
            ->where('parking_spot_id', '=', $reserved_parking_spots->count())
            ->get();

        /**
         * wenn kein Eintrag für den User in der Tabelle parking-spot-users vorhanden (kein Parkplatz reserviert)
         */
        if ($reserved_parking_spots->count() < 1) {
            $viewData['cars'] = DB::table('cars')
                ->select()
                ->join('car_users', 'cars.id', '=', 'car_users.car_id')
                ->where('car_users.user_id', Auth::id())
                ->get();
        }

        return view('user.show', [Auth::id()])->with("viewData", $viewData);
    }
}
