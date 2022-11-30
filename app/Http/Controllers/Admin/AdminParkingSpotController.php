<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkingSpotRequest;
use App\Models\Car;
use App\Models\ParkingSpot;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminParkingSpotController extends Controller
{
    public function index(): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Panel - Parkplatzübersicht - Parkplatzverwaltung';
        $viewData['parking_spots'] = ParkingSpot::getAllParkingSpotsWithCars();
        $viewData['cars'] = Car::with('parkingSpot')->get();

        return view('admin.parking_spot.index')->with("viewData", $viewData);
    }

    public function storeNewParkingSpot(ParkingSpotRequest $request): RedirectResponse
    {

        $count = ParkingSpot::all()->count() + 1;

        $creationData = $request->only(['status']);
        $creationData['user_id'] = 1;
        $creationData['number'] = $count;
        $creationData['row'] = intdiv($count + 1, 4) + 1;

        if ($request->hasFile('image')) {
            $imageName = $request->input('status') . "." . $request->file('image')->extension();
            $creationData['image'] = $imageName;
            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        } else {
            $creationData['image'] = $request['status'] . '.jpg';
        }

        ParkingSpot::create($creationData);

        return back();
    }

    public function delete($id): RedirectResponse
    {
        ParkingSpot::destroy($id);
        return back();
    }

    public function edit($id): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Page - Editiere Fahrzeug - Parkplatzverwaltung';
        $viewData['parking_spot'] = ParkingSpot::findOrFail($id);

        return view('admin.parking_spot.edit')->with('viewData', $viewData);

    }

    public function update(ParkingSpotRequest $request, $id): RedirectResponse
    {
        $parking_spot = ParkingSpot::findOrFail($id);
        $parking_spot->status = $request->input('status');
        $parking_spot->image = $request->input('status') . ".jpg";

        $parking_spot->save();

        return redirect()->route('admin.parking_spot.index');
    }
}
