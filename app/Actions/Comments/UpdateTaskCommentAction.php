<?php

namespace App\Actions\Comments;

use App\Models\Comment;
use Illuminate\Http\Request;

class UpdateTaskCommentAction
{
    public static function do(Comment $comment, Request $request): void
    {
        if ($comment->body == $request->body) {
            return;
        }

        $comment->update([
            'body' => $request->body,
        ]);
    }
}
