<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingSpot;
use App\Models\ParkingSpotUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $userSpot['user_id'] = Auth::id();
        $userSpot['parking_spot_id'] = ParkingSpot::all()->count();

        ParkingSpotUser::create($userSpot);

        return back();
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        ParkingSpot::destroy($id);
        return back();
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Page - Editiere Fahrzeug - Parkplatzverwaltung';
        $viewData['parking_spot'] = ParkingSpot::findOrFail($id);

        return view('admin.parking_spot.edit')->with('viewData', $viewData);

    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
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
