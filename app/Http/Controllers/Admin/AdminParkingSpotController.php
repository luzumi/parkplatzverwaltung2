<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;

class AdminParkingSpotController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Panel - Parkplatzübersicht - Parkplatzverwaltung';
        $viewData['parking_spots'] = ParkingSpot::all();

        return view('admin.parking_spot.index')->with("viewData", $viewData);
    }
}
