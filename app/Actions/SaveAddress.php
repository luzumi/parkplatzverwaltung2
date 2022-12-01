<?php

namespace App\Actions;

use App\Http\Requests\AddressRequest;
use App\Models\Address;

class SaveAddress
{
    /**
     * @param AddressRequest $request
     * @param int $user_id
     * @return Address
     */
    public function handle(AddressRequest $request, int $user_id): Address
    {
        return Address::updateOrCreate([
            'user_id' => $user_id,
            'Land' => $request->input('Land'),
            'PLZ' => $request->input('PLZ'),
            'Stadt' => $request->input('Stadt'),
            'Strasse' => $request->input('Strasse'),
            'Nummer' => $request->input('Nummer'),
        ]);
    }
}
