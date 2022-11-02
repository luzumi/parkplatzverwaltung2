<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminParkingSpotController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Panel - Parkplatzübersicht - Parkplatzverwaltung';
        $viewData['parking_spots'] = ParkingSpot::all();

        return view('admin.parking_spot.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        ParkingSpot::validate($request);

        $count = ParkingSpot::all()->count() + 1;

        $creationData = $request->only(['status']);
        $creationData['number'] = $count;
        $creationData['row'] = intdiv($count + 1, 3) + 1;
        if ($request->hasFile('image')) {
            $imageName = $request->input('status') . "." . $request->file('image')->extension();
            $creationData['image'] = $imageName;
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        } else {
            $creationData['image'] = $request['status'] . '.jpg';
        }


        ParkingSpot::create($creationData);

        return back();
    }

    public function delete($id)
    {
        ParkingSpot::destroy($id);
        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Page - Editiere Fahrzeug - Parkplatzverwaltung';
        $viewData['parking_spot'] = ParkingSpot::findOrFail($id);

        return view('admin.parking_spot.edit')->with('viewData', $viewData);

    }

    public function update(Request $request, $id)
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
