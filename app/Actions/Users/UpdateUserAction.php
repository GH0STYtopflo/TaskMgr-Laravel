<?php

namespace App\Actions\Users;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateUserAction
{
    public static function do(User $user, UpdateUserRequest $request): void
    {
        $user->email = $request->email ?? $user->email;

        $user->username = $request->username ?? $user->username;

        $user->password = $request->new_password ?? $user->password;

        $user->save();

        LogAction::do($user, ActionStatus::SUCCESS, "Updated user", $user, $request->except('_token'));
    }
}
