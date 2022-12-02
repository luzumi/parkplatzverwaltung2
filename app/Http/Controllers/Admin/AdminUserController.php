<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\AdminCreateUser;
use App\Actions\SaveAddress;
use App\Actions\SetImageName;
use App\Actions\UpdateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Panel - User-Übersicht - Parkplatzverwaltung';
        $viewData['users'] = User::all();

        return view('admin.user.index')->with("viewData", $viewData);
    }


    /**
     * @param UserRequest $request
     * @param AdminCreateUser $createUser
     * @param SetImageName $setImageName
     * @param User $user
     * @return RedirectResponse
     */
    public function store(UserRequest $request, AdminCreateUser $createUser, SetImageName $setImageName, User $user): RedirectResponse
    {
        $createUser->handle($request, $setImageName, $user);

        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        User::destroy($id);
        return back();
    }

    /**
     * @param $id
     * @return Factory|View|Application
     */
    public function edit($id): Factory|View|Application
    {
        $viewData = [];
        $viewData['title'] = 'Admin-Page - Editiere Fahrzeug - Parkplatzverwaltung';
        $viewData['user'] = User::findOrFail($id);
        $viewData['address'] = Address::where('user_id', $id)->first();

        return view('admin.user.edit')->with('viewData', $viewData);

    }

    /**
     * @param UserRequest $request
     * @param AddressRequest $addressRequest
     * @param SetImageName $setImageName
     * @param UpdateUser $updateUser
     * @param SaveAddress $saveAddress
     * @param $user_id
     * @return Application|Factory|View
     */
    public function update(UserRequest    $request,
                           AddressRequest $addressRequest,
                           SetImageName   $setImageName,
                           UpdateUser     $updateUser,
                           SaveAddress    $saveAddress,
                                          $user_id): Application|Factory|View
    {
        $updateUser->update($request, $updateUser, $setImageName, $user_id);
        $saveAddress->handle($addressRequest, $user_id);

        $viewData['title'] = 'Admin-Page - Editiere Fahrzeug - Parkplatzverwaltung';
        $viewData['users'] = User::all();
        $viewData['address'] = Address::where('user_id', $user_id)->first();

        return view('admin.user.index')->with("viewData", $viewData);
    }
}
