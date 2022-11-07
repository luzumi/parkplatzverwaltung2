<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarUserController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'User add a Car - Parkplatzverwaltung';
        $viewData['users'] = User::all()->where('id', Auth::id());
        $viewData['name'] = User::findOrFail(Auth::id())['name'];
        $viewData['test'] = "";
        return view('user.addCar.index')->with("viewData", $viewData);
    }




    public function storeCar(Request $request)
    {
        Car::validate($request);

        if ($request->hasFile('image')) {
            $imageName = $request->input('sign') .".". $request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        } else {
            $imageName = 'unregistered_user.png';
        }

        $newCar = new Car();
        $newCar -> setSign($request->input('sign'));
        $newCar -> setManufacturer($request->input('manufacturer'));
        $newCar -> setModel($request->input('model'));
        $newCar -> setColor($request->input('color'));
        $newCar -> setImage($imageName);
        $newCar -> setStatus(true);
        $newCar -> save();

        $id = Car::all()->last()['id'];
        $carUserEntry = new CarUser();
        $carUserEntry['car_id'] = $id;
        $carUserEntry['user_id'] = Auth::id();
        $carUserEntry->save();

        return redirect('/user/' . Auth::id());
    }
}
