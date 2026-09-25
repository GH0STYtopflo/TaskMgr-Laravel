<?php

namespace App\Actions\Comments;

use App\Models\Comment;

class DeleteTaskCommentAction
{
    public static function do(Comment $comment): void
    {
        $comment->delete();
    }
}
