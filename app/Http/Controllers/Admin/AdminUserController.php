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

        $input = $request->input('name') ?? 'unregistered_user.png';
        $extension = $request->file('image')->extension();
        $linker = new StorageLinker([$input, $extension]);

        $user = $request->only(['name', 'email', 'telefon']);

        if ($request->hasFile('image')) {
            $imageName = $linker['hash'];
            $user['image'] = $imageName;
            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        } else {
            $user['image'] = 'unregistered_user.png';
        }

        $user['role'] = 'client';
        $user['password'] = 'password';
        $user['remember_token'] = 'token_';
        $user['email_verified_at'] = now();

        User::create($user);

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

        $input = $request->input('name');
        $extension = $request->file('image')->extension();
        $linker = new StorageLinker([$input, $extension]);
        $user = User::findOrFail($id);
        $user->setName($input);
        $user->setEmail($request->input('email'));
        $user->setTelefon($request->input('telefon'));

        if ($request->hasFile('image')) {
            $imageName = $linker['hash'];
            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())

            );
        }

        $user->setImage($imageName ?? 'no image');

        $user->save();

        return redirect()->route('admin.user.index');
    }
}
