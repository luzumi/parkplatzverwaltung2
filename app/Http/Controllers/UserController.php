<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Parkplatzverwaltung";
        $viewData["subtitle"] =  "User-Übersicht";
        $viewData["users"] = User::all();
        return view('user.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $user = User::findOrFail($id);
        $viewData["title"] = $user["name"]." - Parkplatzverwaltung";
        $viewData["subtitle"] =  $user["name"]." - User information";
        $viewData["user"] = $user;
        //TODO geht nicht
        $cars = DB::table('cars')
            ->select()
            ->join('car_users', 'cars.id' , '=', 'car_users.car_id')
            ->where('car_users.user_id', Auth::id())
        ->get();
        $viewData['cars'] = $cars;
        return view('user.show')->with("viewData", $viewData);
    }
}
