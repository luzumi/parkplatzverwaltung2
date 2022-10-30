<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
//        ["id"=>"1", "name"=>"Holger Erkenbrecher",  "email"=>"Guzuguz@hotas.as",    "image" => "1.jpg", "telefon"=>"088 388943234", "status"=>"admin"],
//        ["id"=>"2", "name"=>"Ernst Müller",         "email"=>"emuell@muell.er",     "image" => "2.jpg", "telefon"=>"026 7545155", "status"=>"anonym"],
//        ["id"=>"3", "name"=>"Leo Damm",             "email"=>"LeoDamm@webbe.ff",    "image" => "3.jpg", "telefon"=>"042 2566221", "status"=>"user"],
//        ["id"=>"4", "name"=>"Gabi Förster",         "email"=>"gabiF@hot.ea",        "image" => "4.jpg", "telefon"=>"0234 246567223", "status"=>"user"],
//        ["id"=>"5", "name"=>"Conny Schmidt",        "email"=>"Lemmi@email.de",      "image" => "5.jpg", "telefon"=>"0172 679932576", "status"=>"anonym"],
//        ["id"=>"6", "name"=>"Siegfried von Ahmen",  "email"=>"info@von-ahmen.ll",   "image" => "6.jpg", "telefon"=>"0234 678989558", "status"=>"anonym"],
//        ["id"=>"7", "name"=>"Joe Frezer",           "email"=>"jizzuzi@email.de",    "image" => "7.jpg", "telefon"=>"077 367366", "status"=>"user"],
//        ["id"=>"8", "name"=>"Ollo Mollo",           "email"=>"lool@kista.de",       "image" => "8.jpg", "telefon"=>"03467 68994", "status"=>"user"],
//        ["id"=>"9", "name"=>"Dennis Sokker",        "email"=>"sportsman@stadion.us","image" => "9.jpg", "telefon"=>"030 3467445677", "status"=>"anonym"],


    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Parkplatzverwaltung";
        $viewData["subtitle"] =  "User-Übersicht";
        $viewData["users"] = User::all();
        return view('user.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $user = User::findOrFail($id);
        $viewData["title"] = $user["name"]." - Parkplatzverwaltung";
        $viewData["subtitle"] =  $user["name"]." - User information";
        $viewData["user"] = $user;
        return view('user.show')->with("viewData", $viewData);
    }
}
