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
    /**
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request): User
    {
        // Create user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'image' => 'unregistered_user.jpg'
        ]);

        // Image upload and update user
        if ($request->hasFile('avatar')) {
            $image = $request->file('image')->store('image');
            $user->update(['image' => $image]);
        }

        return $user;
    }

    /**
     * @param UserRequest $request
     * @param $user_id
     * @return RedirectResponse
     */
    public function update(UserRequest $request, $user_id): RedirectResponse
    {
        $user = User::findOrFail($user_id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'telefon' => $request->input('telefon'),
        ]);

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
        $user->update([
            'image' => $this->setImageIfExist($request, $user),
        ]);

        return redirect()->route('user.show', Auth::id());
    }


    /**
     * @param UserRequest|UserPictureRequest $request
     * @param User $user
     * @return string
     */
    public function setImageIfExist(UserRequest|UserPictureRequest $request, User $user): string
    {
            if ($request->hasFile('image')) {
                $storageLinker = new StorageLinker([
                    $user->name,
                    $request->file('image')->extension()]);

                $imageName = $storageLinker['hash'];

                Storage::disk('public/media')->put(
                    $imageName,
                    file_get_contents($request->file('image')->getRealPath())
                );
            }
            $user->image = $imageName;
        return $user->image;
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
