<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Panel - User-Übersicht - Parkplatzverwaltung';
        $viewData['users'] = User::all();

        return view('admin.user.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:12",
            'email' => "required|email",
            "telefon" => "required",
//            "image" => "image",
        ]);

//        $newCar = new Car();
//        $newCar -> setSign($request->input('sign'));
//        $newCar -> setManufacturer($request->input('manufacturer'));
//        $newCar -> setModel($request->input('model'));
//        $newCar -> setColor($request->input('color'));
//        $newCar -> setImage($request->input('testCar.png'));
//        $newCar -> setStatus(true);
//        $newCar -> save();

        $creationData = $request->only(['name', 'email', 'telefon']);
        $creationData['status'] = 'user';
        $creationData['password'] = 'password';
        $creationData['remember_token'] = 'token_';
        $creationData['email_verified_at'] = now();
        $creationData['image'] = 'unregistered_user.png';

        User::create($creationData);

        return back();
    }
}
