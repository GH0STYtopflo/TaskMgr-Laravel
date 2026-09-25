<?php

namespace App\Actions\Comments;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Comments\CreateOrUpdateTaskCommentRequest;
use App\Models\Task;

class CreateTaskCommentAction
{
    public static function do(Task $task, CreateOrUpdateTaskCommentRequest $request): void
    {
        $comment = $task->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        // To directions of the same relationship
        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Created comment", $comment, $request->except('_token'));
        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Commented", $comment->task, $request->except('_token'));
    }
}
