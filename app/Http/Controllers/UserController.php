<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarUser;
use App\Models\ParkingSpot;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function React\Promise\all;

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


        $carUsers = CarUser::first();
        $user = User::where('id', Auth::id())
            ->get();




        $viewData['cars'] = $user;

//        $viewData['cars'] = DB::table('cars')
//            ->select()
//            ->join('car_users', 'cars.id', '=', 'car_users.car_id')
//            ->where('car_users.user_id', Auth::id())
//            ->join('parking_spot_users', 'car_users.user_id', '<', 'parking_spot_users.user_id')
//            ->get();



        return view('user.show', [Auth::id()])->with("viewData", $viewData);
    }
}
