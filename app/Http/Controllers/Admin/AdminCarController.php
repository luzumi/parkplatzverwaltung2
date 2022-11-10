<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        $creationData = $request->only(['id', 'sign', 'manufacturer', 'model', 'color']);

        if ($request->hasFile('image')) {
            $imageName = $request->input('sign') . "." . $request->file('image')->extension();
            $creationData['image'] = $imageName;

            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        } else {
            $creationData['image'] = 'testCar.png';
        }

        $creationData['status'] = true;

        Car::create($creationData);

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
        $car->setSign($request->input('sign'));
        $car->setManufacturer($request->input('manufacturer'));
        $car->setModel($request->input('model'));
        $car->setColor($request->input('color'));


        if ($request->hasFile('image')) {
            $imageName = $request->input('sign') . "." . $request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        }

        $car->save();

        return redirect()->route('admin.car.index');
    }
}
