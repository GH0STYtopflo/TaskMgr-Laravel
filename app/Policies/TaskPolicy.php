<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    public function nonAdminUpdateAndShow(User $user, Task $task): Response
    {
        if ($task->users()->where('user_id', $user->id)->exists()) {
            return Response::allow();
        } else {
            return Response::denyAsNotFound();
        }
    }
}
