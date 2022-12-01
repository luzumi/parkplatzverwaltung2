<?php

namespace App\Actions\Admin;

use App\Actions\SetImageName;
use App\Http\Requests\UserRequest;
use App\Models\User;

class AdminCreateUser
{
    /**
     * @param UserRequest $request
     * @return User
     */
    public function handle(UserRequest $request): User
    {
        return User::updateOrCreate([
            'name' => 'CreatedByAdmin-' . $request->input('name'),
            'email' => $request->input('email'),
            'telefon' => $request->input('telefon'),
            'image' => 'unregistered_user.png',
            'role' => 'client',
            'password' => 'password',
            'remember_token' => 'token_',
            'email_verified_at' => now(),
        ]);
    }
}
