<?php

namespace App\Actions\Auth;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SignupAction
{
    public static function do(SignupRequest $request): User
    {
        $user = User::make(
            $request->except('_token', 'password')
        );

        $user->password = $request->password;
        $user->save();

        Auth::login($user);

        LogAction::do($user, ActionStatus::SUCCESS, "User $user->id signed up.", $user,
            $request->except('_token', 'password'));

        return $user;
    }
}
