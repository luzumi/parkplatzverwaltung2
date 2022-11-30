<?php

namespace App\Http\Controllers;

use App\Actions\SaveAddress;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @method static update(Request $request, $id)
 */
class AddressController extends Controller
{
    public function create(AddressRequest $request, SaveAddress $saveAddress, int $user_id): Application|Factory|View
    {
        $address = $saveAddress->handle($request, $user_id);

        $viewData['user'] = User::findOrFail($user_id);
        $viewData['cars'] = Car::where('user_id', $user_id);
        $viewData['address'] = $address;
        $viewData['title'] = $viewData['user']->name . " - Parkplatzverwaltung";
        $viewData['subtitle'] = $viewData['user']->name . " - User information";

        return view('user.show', [$user_id])->with("viewData", $viewData);
    }
}
