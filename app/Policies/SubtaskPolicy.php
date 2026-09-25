<?php

namespace App\Policies;

use App\Models\Subtask;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubtaskPolicy
{
    public function updateSubStatus(User $user, Subtask $subtask): Response
    {
        if ($subtask->task->users()->where('user_id', $user->id)->exists()) {
            return Response::allow();
        } else {
            return Response::denyAsNotFound();
        }
    }
}
