<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\StorageLinker;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminCarController extends Controller
{
    public function index(): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Panel - Fahrzeugübersicht - Parkplatzverwaltung';
        $viewData['cars'] = Car::getAllCarWithParkingSpot();

        return view('admin.car.index')->with("viewData", $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Car::validate($request);

        $input = $request->input('sign');
        $extension = $request->file('image')->extension();
        $linker = new StorageLinker([$input, $extension]);

        $car = $request->only(['id', 'sign', 'manufacturer', 'model', 'color']);
        if ($request->hasFile('image')) {
            $imageName = $linker['hash'];
            $car->image = $imageName;
            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        } else {
            $car->image = 'testCar.png';
        }

        $car->status = true;

        Car::create($car);

        return back();
    }

    public function delete($id): RedirectResponse
    {
        Car::destroy($id);
        return back();
    }

    public function edit($id): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Page - Editiere Fahrzeug - Parkplatzverwaltung';
        $viewData['car'] = Car::findOrFail($id);

        return view('admin.car.edit')->with('viewData', $viewData);

    }

    public function update(Request $request, $id): RedirectResponse
    {
        Car::validate($request);

        $car = Car::findOrFail($id);
        if ($request->hasFile('image')) {
            $input = $request->input('name') ?? 'unregistered_user.png';
            $extension = $request->file('image')->extension();
            $linker = new StorageLinker([$input, $extension]);
            $imageName = $linker['hash'];
            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $car->image = $linker['hash'];
        }


        $car->sign = $request->input('sign');
        $car->manufacturer= $request->input('manufacturer');
        $car->model = $request->input('model');
        $car->color = $request->input('color');

        $car->save();

        return redirect()->route('admin.car.index');
    }
}
