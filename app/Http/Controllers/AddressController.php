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
    public function create(AddressRequest $request, SaveAddress $saveAddress, int $user_id): \Illuminate\Http\RedirectResponse
    {
        $address = $saveAddress->handle($request, $user_id);

        return redirect()->route('user.show', $user_id);
    }
}
