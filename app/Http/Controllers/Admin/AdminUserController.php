<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Panel - User-Übersicht - Parkplatzverwaltung';
        $viewData['users'] = User::all();

        return view('admin.user.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        User::validate($request);

//        $newCar = new Car();
//        $newCar -> setSign($request->input('sign'));
//        $newCar -> setManufacturer($request->input('manufacturer'));
//        $newCar -> setModel($request->input('model'));
//        $newCar -> setColor($request->input('color'));
//        $newCar -> setImage($request->input('testCar.png'));
//        $newCar -> setStatus(true);
//        $newCar -> save();

        $creationData = $request->only(['name', 'email', 'telefon']);


        if ($request->hasFile('image')) {
            $imageName = $request->input('name') .".". $request->file('image')->extension();
            $creationData['image'] = $imageName;
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        } else {
            $creationData['image'] = 'unregistered_user.png';
        }

        $creationData['status'] = 'user';
        $creationData['password'] = 'password';
        $creationData['remember_token'] = 'token_';
        $creationData['email_verified_at'] = now();

        User::create($creationData);

        return back();
    }

    public function delete($id)
    {
        User::destroy($id);
        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Page - Editiere Fahrzeug - Parkplatzverwaltung';
        $viewData['user'] = User::findOrFail($id);

        return view('admin.user.edit')->with('viewData', $viewData);

    }

    public function update(Request $request, $id)
    {
        User::validate($request);

        $user = User::findOrFail($id);
        $user->setName($request->input('name'));
        $user->setEmail($request->input('email'));
        $user->setTelefon($request->input('telefon'));
        $user->setStatus($request->input('status'));

        if ($request->hasFile('image')) {
            $imageName = $request->input('name') . "." . $request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        }

        $user->save();

        return redirect()->route('admin.user.index');
    }
}
