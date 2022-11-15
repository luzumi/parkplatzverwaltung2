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
        $viewData['cars'] = Car::all();

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
            $car['image'] = $imageName;
            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        } else {
            $car['image'] = 'testCar.png';
        }

        $car['status'] = true;

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

        $input = $request->input('sign');
        $extension = $request->file('image')->extension();
        $linker = new StorageLinker([$input, $extension]);

        $car = Car::findOrFail($id);
        $car->setSign($request->input('sign'));
        $car->setManufacturer($request->input('manufacturer'));
        $car->setModel($request->input('model'));
        $car->setColor($request->input('color'));
        $car->setImage($linker['hash']);


        if ($request->hasFile('image')) {
            $imageName = $linker['hash'];
            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        }

        $car->save();

        return redirect()->route('admin.car.index');
    }
}
