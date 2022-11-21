<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Car;
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
    public function create(Request $request, $id): Application|Factory|View
    {
        Address::validate($request);
        $address = Address::all()->where('user_id', $id)->first();
        $address->Land = $request['Land'];
        $address->PLZ = $request->input('PLZ');
        $address->Stadt = $request->input('Stadt');
        $address->Strasse = $request->input('Strasse');
        $address->Nummer = $request->input('Nummer');
        $address->setCreatedAt(now());
        $address->setUpdatedAt(now());
//        dd($address);
        $address->save();

        $viewData['user'] = Auth::user();
        $viewData['cars'] = Car::all()->where('user_id', Auth::id());
        $viewData['address'] = Address::all()->where('user_id', Auth::id())->first();

        $viewData['title'] = $viewData['user']->name . " - Parkplatzverwaltung";
        $viewData['subtitle'] = $viewData['user']->name . " - User information";

        return view('user.show', [$id])->with("viewData", $viewData);
    }



}
