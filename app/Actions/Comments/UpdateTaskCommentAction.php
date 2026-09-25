<?php

namespace App\Actions\Comments;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Comments\CreateOrUpdateTaskCommentRequest;
use App\Models\Comment;

class UpdateTaskCommentAction
{
    public static function do(Comment $comment, CreateOrUpdateTaskCommentRequest $request): void
    {
        if ($comment->body == $request->body) {
            LogAction::do(\Auth::user(), ActionStatus::NA, "Did not update comment since no changes where made",
                $comment, $request->except('_token'));
            return;
        }

        $comment->update([
            'body' => $request->body,
        ]);

        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Updated comment", $comment, $request->except('_token'));
    }
}
