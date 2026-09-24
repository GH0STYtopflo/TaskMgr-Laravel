<?php

namespace App\Actions\Users;

use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\User;

class UpdateUserAction
{
    public static function do(User $user, UpdateTaskRequest $request): void
    {
        $user->email = $request->email ?? $user->email;

        $user->username = $request->username ?? $user->username;

        if (!is_null($request->new_password)) {
            $user->password = $request->new_password;
        }

        $user->save();
    }
}
