<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::query()
        ->when($request->username, function ($query, $username) {
            $query->getModel()->user()->whereUsername($username);
        })->when($request->task_id, function ($query, $task_id) {
            $query->where('task_id', $task_id);
        })->when($request->before, function ($query, $before) {
            $query->where('created_at', '<=', $before);
        })->when($request->after, function ($query, $after) {
            $query->where('created_at', '>=', $after);
        })->when($request->keyword, function ($query, $keyword) {
            $query->where('body', 'like', "%$keyword%");
        })
            ->with(['task', 'user'])->get();

        return view('comments.index', ['comments' => $comments]);
    }
}
