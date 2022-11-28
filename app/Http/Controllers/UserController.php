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

    public function show($user_id): Factory|View|Application
    {
        $user = User::findOrFail($user_id);

        $viewData = [];
        $viewData['user'] = $user;
        $viewData['cars'] = Car::getCarWithParkingSpot($user_id);
        $viewData['address'] = Address::all()->where('user_id', $user_id)->first();

        $viewData['title'] = $user['name'] . " - Parkplatzverwaltung";
        $viewData['subtitle'] = $user['name'] . " - User information";

        return view('user.show', [$user_id])->with("viewData", $viewData);
    }

    public function editor($user_id): Factory|View|Application
    {
        $user = User::findOrFail($user_id);

        $viewData = [];
        $viewData["subtitle"] = $user["name"] . " - User editor";
        $viewData['address'] = Address::all()->where('user_id', Auth::id())->first();

        $viewData["user"] = $user;
        $viewData["title"] = $user["name"] . "Benutzerdaten editieren - Parkplatzverwaltung";
        return view('user.editor-id', [$user_id])->with("viewData", $viewData);

    }

    public function update(Request $request, $user_id): RedirectResponse
    {
        User::validate($request);

        $input = $request->input('name');
        $user = User::findOrFail($user_id);
        $user->name = $input;
        $user->email = $request->input('email');
        $user->telefon = $request->input('telefon');

        if ($request->input('password')) {
            $user->password = $request->input('password');
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
            $user->image = $imageName;
        }
        $user->save();

        return redirect()->route('user.show', Auth::id());
    }

    public function updatePicture(Request $request, $user_id): RedirectResponse
    {
        $input = Auth::user()->name;
        $user = User::findOrFail($user_id);

//dd($input);
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
            $user->image = $imageName ?? 'no image';
        }
        $user->update();

        return redirect()->route('user.show', Auth::id());
    }

    public function delete()
    {
        User::destroy(Auth::id());
        Address::where('user_id', Auth::id())->delete();
        Car::where('user_id', Auth::id())->delete();
        ParkingSpot::resetParkingSpot();

        return redirect('/');
    }
}
