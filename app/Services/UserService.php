<?php

namespace App\Services;

use App\Actions\SetImageName;
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
    public function updatePicture(UserPictureRequest $request, SetImageName $setImageName, $user_id): RedirectResponse
    {
        $user = User::findOrFail($user_id);
        $user->update([
            'image' => $setImageName->handle($request, $user),
        ]);

        return redirect()->route('user.show', Auth::id());
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
