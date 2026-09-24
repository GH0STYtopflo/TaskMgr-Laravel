<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * vud (View, Update, Delete, Dashboard)
     */
    public function vudd(User $user, User $model): Response
    {
        if ($user->is($model) || $user->is_admin) {
            return Response::allow();
        } else {
            return Response::denyAsNotFound();
        }
    }
}
