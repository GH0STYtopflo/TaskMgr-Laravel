<?php

namespace App\Actions\Comments;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;

class DeleteTaskCommentAction
{
    public static function do(Comment $comment): void
    {
        $comment->delete();
    }
}
