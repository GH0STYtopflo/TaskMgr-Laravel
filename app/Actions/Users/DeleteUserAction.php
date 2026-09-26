<?php

namespace App\Actions\Users;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeleteUserAction
{
    public static function do(User $user): void
    {
        $user->delete();

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Deleted user", User::class);
    }
}
