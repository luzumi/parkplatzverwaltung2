<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StorageLinker;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function index(): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Panel - User-Übersicht - Parkplatzverwaltung';
        $viewData['users'] = User::all();

        return view('admin.user.index')->with("viewData", $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        User::validate($request);

//        $newCar = new Car();
//        $newCar -> setSign($request->input('sign'));
//        $newCar -> setManufacturer($request->input('manufacturer'));
//        $newCar -> setModel($request->input('model'));
//        $newCar -> setColor($request->input('color'));
//        $newCar -> setImage($request->input('testCar.png'));
//        $newCar -> set  (true);
//        $newCar -> save();

        $creationData = $request->only(['name', 'email', 'telefon']);


        if ($request->hasFile('image')) {
            $imageName = $request->input('name') . "." . $request->file('image')->extension();
            $creationData['image'] = $imageName;
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        } else {
            $creationData['image'] = 'unregistered_user.png';
        }

        $creationData['role'] = 'client';
        $creationData['password'] = 'password';
        $creationData['remember_token'] = 'token_';
        $creationData['email_verified_at'] = now();

        User::create($creationData);

        return back();
    }

    public function delete($id): RedirectResponse
    {
        User::destroy($id);
        return back();
    }

    public function edit($id): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Page - Editiere Fahrzeug - Parkplatzverwaltung';
        $viewData['user'] = User::findOrFail($id);

        return view('admin.user.edit')->with('viewData', $viewData);

    }

    public function update(Request $request, $id): RedirectResponse
    {
        User::validate($request);
        $user = User::findOrFail($id);

        $input = $request->input('name');
        $hashInput = Hash::make($input);
        $extension = $request->file('image')->extension();

        $user->setName($input);
        $user->setEmail($request->input('email'));
        $user->setTelefon($request->input('telefon'));

        if ($request->hasFile('image')) {
            $imageName = $hashInput . "." . $extension;
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())

            );
        }
        $user->setImage($imageName ?? 'no image');
        $user->save();

        new StorageLinker([$input, $extension]);


        return redirect()->route('admin.user.index');
    }
}
