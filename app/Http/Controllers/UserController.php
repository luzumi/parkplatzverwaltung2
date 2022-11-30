<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

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

    public function show($user_id): Factory|View|Application
    {
        $user = User::findOrFail($user_id);

        $viewData = [];
        $viewData['user'] = $user;
        $viewData['cars'] = Car::with('parkingSpot')->where('cars.user_id', $user_id)->get();
        $viewData['address'] = Address::where('user_id', $user_id)->first();
        $viewData['title'] = $user['name'] . " - Parkplatzverwaltung";
        $viewData['subtitle'] = $user['name'] . " - User information";

        return view('user.show', [$user_id])->with("viewData", $viewData);
    }

    public function editor($user_id): Factory|View|Application
    {
        $user = User::findOrFail($user_id);

        $viewData = [];
        $viewData["subtitle"] = $user["name"] . " - User editor";
        $viewData['address'] = Address::where('user_id', $user_id)->first();
        $viewData["user"] = $user;
        $viewData["title"] = $user["name"] . "Benutzerdaten editieren - Parkplatzverwaltung";

        return view('user.editor-id', [$user_id])->with("viewData", $viewData);

    }
}
