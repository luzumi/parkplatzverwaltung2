<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Car;
use App\Models\ParkingSpot;
use App\Models\StorageLinker;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index(): Factory|View|Application
    {
        $viewData = [];
        $viewData["title"] = "Parkplatzverwaltung";
        $viewData["subtitle"] = "User-Übersicht";
        $viewData["users"] = User::all();

        return view('user.index')->with("viewData", $viewData);
    }

    public function show(): Factory|View|Application
    {

        $viewData = [];
        $user = User::findOrFail(Auth::id());
        $viewData['user'] = $user;
        $viewData['cars'] = Car::with('parkingSpot')
            ->select(
                'cars.id',
                'cars.sign',
                'cars.image',
                'cars.manufacturer',
                'cars.model',
                'cars.color'
            )
            ->where('cars.user_id', Auth::id())
            ->join('parking_spots', 'parking_spots.user_id', '=', 'cars.user_id')
            ->distinct()
            ->get();
        $viewData['address'] = Address::all()->where('user_id', Auth::id())->first();
        $viewData['title'] = $user['name'] . " - Parkplatzverwaltung";
        $viewData['subtitle'] = $user['name'] . " - User information";
//dd($viewData);
        return view('user.show', [Auth::id()])->with("viewData", $viewData);
    }

    public function editor($id): Factory|View|Application
    {
        $viewData = [];
        $user = User::findOrFail($id);
        $viewData["user"] = $user;
        $viewData["title"] = $user["name"] . "Benutzerdaten editieren - Parkplatzverwaltung";
        $viewData["subtitle"] = $user["name"] . " - User editor";
        $viewData['address'] = Address::all()->where('user_id', Auth::id())->first();
//dd($viewData['address']);
        return view('user.editor-id', [$id])->with("viewData", $viewData);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        User::validate($request);

        $input = $request->input('name');
        $user = User::findOrFail($id);
        $user->setName($input);
        $user->setEmail($request->input('email'));
        $user->setTelefon($request->input('telefon'));

        if ($request->input('password')) {
            $user->setPassword($request->input('password'));
        }
        if ($request->file('image') !== null) {
            $extension = $request->file('image')->extension();
            $linker = new StorageLinker([$input, $extension]);
            if ($request->hasFile('image')) {
                $imageName = $linker['hash'];
                Storage::disk('public/media')->put(
                    $imageName,
                    file_get_contents($request->file('image')->getRealPath())
                );
            }
            $user->setImage($imageName ?? 'no image');
        }

        $user->save();


        return redirect()->route('user.show', Auth::id());
    }

    public function updatePicture(Request $request, $id): RedirectResponse
    {
//dd($request->file('image'));
        $input = Auth::user()->getName();
        $user = User::findOrFail($id);

        if ($request->file('image') !== null) {
            $extension = $request->file('image')->extension();
            $linker = new StorageLinker([$input, $extension]);
            if ($request->hasFile('image')) {
                $imageName = $linker['hash'];
                Storage::disk('public/media')->put(
                    $imageName,
                    file_get_contents($request->file('image')->getRealPath())
                );
            }
            $user->setImage($imageName ?? 'no image');
        }

        $user->update();


        return redirect()->route('user.show', Auth::id());
    }
}
