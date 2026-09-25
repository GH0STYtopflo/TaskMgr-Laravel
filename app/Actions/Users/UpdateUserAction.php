<?php

namespace App\Actions\Users;

use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;

class UpdateUserAction
{
    public static function do(User $user, UpdateUserRequest $request): void
    {
        $user->email = $request->email ?? $user->email;

        $user->username = $request->username ?? $user->username;

        $user->password = $request->password ?? $user->password;

        $user->save();
    }
}
