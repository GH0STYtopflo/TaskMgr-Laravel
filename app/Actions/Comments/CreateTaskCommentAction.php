<?php

namespace App\Actions\Comments;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateTaskCommentAction
{
    public static function do(Task $task, Request $request): void
    {
        $task->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);
    }
}
