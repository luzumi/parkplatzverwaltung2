<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $viewData['parking_spots'] = ParkingSpot::all();

        return view('admin.parking_spot.index')->with("viewData", $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        ParkingSpot::validate($request);

        $count = ParkingSpot::all()->count() + 1;

        $creationData = $request->only(['status']);
        $creationData['user_id'] = 1;
        $creationData['number'] = $count;
        $creationData['row'] = intdiv($count + 1, 3) + 1;

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

    public function update(Request $request, $id): RedirectResponse
    {
        ParkingSpot::validate($request);

        $parking_spot = ParkingSpot::findOrFail($id);
        $parking_spot->setStatus($request->input('status'));

        $parking_spot['image'] = $request->input('status') . ".jpg";

//        if ($request->hasFile('image')) {
//            $imageName = $request->input('status') . "." . $request->file('image')->extension();
//            $parking_spot['image'] = $imageName;
//            Storage::disk('public')->put(
//                $imageName,
//                file_get_contents($request->file('image')->getRealPath())
//            );
//        }

        $parking_spot->save();

        return redirect()->route('admin.parking_spot.index');
    }
}
