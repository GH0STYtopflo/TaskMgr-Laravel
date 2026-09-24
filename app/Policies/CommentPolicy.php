<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function create(User $user, Task $task): Response
    {
        if ($task->users()->where('user_id', $user->id)->exists() || $user->is_admin) {
            return Response::allow();
        } else {
            return Response::denyAsNotFound();
        }
    }

    public function updateOrDestroy(User $user, Comment $comment, Task $task): Response
    {
        if (($task->users()->where('user_id', $user->id)->exists() && $comment->user->is($user)) || $user->is_admin) {
            return Response::allow();
        } else {
            return Response::denyAsNotFound();
        }
    }
}
