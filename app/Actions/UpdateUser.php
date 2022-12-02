<?php

namespace App\Actions;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UpdateUser
{
    /**
     * @param UserRequest $request
     * @param UpdateUser $updateUser
     * @param SetImageName $setImageName
     * @param int $user_id
     * @return User
     */
    public function update(UserRequest  $request,
                           UpdateUser   $updateUser,
                           SetImageName $setImageName,
                           int          $user_id): User
    {
        $user = User::findOrFail($user_id);

        return $user->updateOrCreate([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'telefon' => $request->input('telefon'),
            'image' => $setImageName->handle($request, $user)
        ]);
    }
}
