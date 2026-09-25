<?php

namespace App\Actions\Comments;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Comment;

class DeleteTaskCommentAction
{
    public static function do(Comment $comment): void
    {
        $comment->delete();

        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Comment deleted", $comment);
    }
}
