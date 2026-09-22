<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Task $task ,Request $request)
    {
        $task->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update($task, Comment $comment, Request $request)
    {
        if ($comment->body == $request->body) {
            return back();
        }

        $comment->update([
            'body' => $request->body,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($task, Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
