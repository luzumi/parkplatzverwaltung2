<?php

namespace App\Services;

use App\Http\Requests\UserPictureRequest;
use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\Car;
use App\Models\ParkingSpot;
use App\Models\StorageLinker;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function createUser(Request $request): User
    {
        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Image upload and update user
        if ($request->hasFile('avatar')) {
            $image = $request->file('image')->store('image');
            $user->update(['image' => $image]);
        }

        return $user;
    }

    public function update(UserRequest $request, $user_id): RedirectResponse
    {
        $user = User::findOrFail($user_id);
        $this->setImageIfExist($request, $user);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->telefon = $request->input('telefon');
        $user->save();

        return redirect()->route('user.show', Auth::id());
    }

    /**
     * @param UserPictureRequest $request
     * @param $user_id
     * @return RedirectResponse
     */
    public function updatePicture(UserPictureRequest $request, $user_id): RedirectResponse
    {
        $user = User::findOrFail($user_id);
        $this->setImageIfExist($request, $user);

        return redirect()->route('user.show', Auth::id());
    }


    /**
     * @param UserRequest|UserPictureRequest $request
     * @param User $user
     * @return void
     */
    public function setImageIfExist(UserRequest|UserPictureRequest $request, User $user): void
    {
        if ($request->hasFile('image')) {
            $linker = new StorageLinker([
                $request->file('originalName'),
                $request->file('image')->extension(),
            ]);
            $linker->save();
            $imageName = $linker['hash'];

            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $user->update([
                'image' => $imageName,
            ]);
//            dd($request, $linker, $imageName, $user);
        }
    }

    /**
     * @return Redirector|Application|RedirectResponse
     */
    public function delete(): Redirector|Application|RedirectResponse
    {
        User::destroy(Auth::id());
        Address::where('user_id', Auth::id())->delete();
        Car::where('user_id', Auth::id())->delete();
        ParkingSpot::resetParkingSpot();

        return redirect('/');
    }
}
