<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\ParkingSpot;
use App\Models\StorageLinker;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{

    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Parkplatzverwaltung';
        $viewData['subtitle'] = 'Fahrzeugübersicht';
        $viewData['cars'] = Car::all();

        return view('cars.index')->with('viewData', $viewData);
    }

    public function storeIndex(): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'User add a Car - Parkplatzverwaltung';
        $viewData['users'] = User::findOrFail(Auth::id());

        return view('user.addCar.index')->with("viewData", $viewData);
    }

    public function show($id): Factory|View|Application
    {

        $viewData = [];
        $car = Car::findOrFail($id);
        $viewData['title'] = 'Reservierung: ' . $car->sign;
        $viewData['subtitle'] = 'Details von ' . $car->sign;

        $viewData['car'] = $car;
        $viewData['parking_spots'] = ParkingSpot::where('status','=','frei');
        $viewData['selected_spot'] = 0;

        return view('cars.show', [$id])->with('viewData', $viewData);
    }

    public function storeCar(Request $request): Redirector|Application|RedirectResponse
    {
        Car::validate($request);

        $input = $request->input('name') ?? 'unregistered_user.png';
        $extension = $request->file('image')->extension();
        $linker = new StorageLinker([$input, $extension]);

        if ($request->hasFile('image')) {
            $imageName = $linker['hash'];
            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        }

        $newCar = new Car();
        $newCar->user_id = Auth::id();
        $newCar->sign = $request->input('sign');
        $newCar->manufacturer = $request->input('manufacturer');
        $newCar->model = $request->input('model');
        $newCar->color = $request->input('color');
        $newCar->image = $linker['hash'];
        $newCar->status = true;
        $newCar->save();


        return redirect('/user/' . Auth::id());
    }
}
