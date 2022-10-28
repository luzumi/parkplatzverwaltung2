<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParkingSpotController extends Controller
{
    public static $parking_spots = [
        ["id"=>"1",  "number"=>"1",  "row"=>"1", "image" => "./img/parking_spot.png", "status"=>true],
        ["id"=>"2",  "number"=>"2",  "row"=>"1", "image" => "./img/parking_spot.png", "status"=>true],
        ["id"=>"3",  "number"=>"3",  "row"=>"1", "image" => "./img/parking_spot.png", "status"=>false],
        ["id"=>"4",  "number"=>"4",  "row"=>"1", "image" => "./img/parking_spot.png", "status"=>false],
        ["id"=>"5",  "number"=>"5",  "row"=>"2", "image" => "./img/parking_spot.png", "status"=>true],
        ["id"=>"6",  "number"=>"6",  "row"=>"2", "image" => "./img/parking_spot.png", "status"=>true],
        ["id"=>"7",  "number"=>"7",  "row"=>"2", "image" => "./img/parking_spot.png", "status"=>false],
        ["id"=>"8",  "number"=>"8",  "row"=>"2", "image" => "./img/parking_spot.png", "status"=>false],
        ["id"=>"9",  "number"=>"9",  "row"=>"3", "image" => "./img/parking_spot.png", "status"=>false],
        ["id"=>"10", "number"=>"10", "row"=>"3", "image" => "./img/parking_spot.png", "status"=>false],
        ["id"=>"11", "number"=>"11", "row"=>"3", "image" => "./img/parking_spot.png", "status"=>true],
        ["id"=>"12", "number"=>"12", "row"=>"3", "image" => "./img/parking_spot.png", "status"=>true],
        ["id"=>"13", "number"=>"13", "row"=>"4", "image" => "./img/parking_spot.png", "status"=>true],
        ["id"=>"14", "number"=>"14", "row"=>"5", "image" => "./img/parking_spot.png", "status"=>false],
        ["id"=>"15", "number"=>"15", "row"=>"5", "image" => "./img/parking_spot.png", "status"=>false],
        ["id"=>"16", "number"=>"16", "row"=>"5", "image" => "./img/parking_spot.png", "status"=>true],

    ];

    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Parkplatzverwaltung";
        $viewData["subtitle"] =  "Parkplatzübersicht";
        $viewData["parking_spots"] = ParkingSpotController::$parking_spots;
        return view('parking_spots.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $parking_spot = ParkingSpotController::$parking_spots[$id-1];
        $viewData["title"] = "Parkplatzansicht";
        $viewData["subtitle"] =  "Parkplatz Nr. " . $parking_spot["name"];
        $viewData["parking_spot"] = $parking_spot;
        return view('parking_spots.show')->with("viewData", $viewData);
    }
}
