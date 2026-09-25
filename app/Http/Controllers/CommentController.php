<?php

namespace App\Http\Controllers;

use App\Actions\Comments\CreateTaskCommentAction;
use App\Actions\Comments\DeleteTaskCommentAction;
use App\Actions\Comments\QueryCommentsAction;
use App\Actions\Comments\UpdateTaskCommentAction;
use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Comments\CreateOrUpdateTaskCommentRequest;
use App\Http\Requests\Comments\CreateTaskCommentRequest;
use App\Http\Requests\Comments\QueryCommentsRequest;
use App\Models\Comment;
use App\Models\Task;
use Gate;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(QueryCommentsRequest $request)
    {
        $comments = QueryCommentsAction::do($request);

        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Queried comments.", Comment::class, $request->except('_token'));

        return view('comments.index', ['comments' => $comments]);
    }

    public function storeTaskComment(Task $task, CreateOrUpdateTaskCommentRequest $request)
    {
        Gate::authorize('create', [Comment::class, $task]);

        CreateTaskCommentAction::do($task, $request);

        return back();
    }

    public function updateTaskComment(Task $task, Comment $comment, CreateOrUpdateTaskCommentRequest $request)
    {
        Gate::authorize('updateOrDestroy', [$comment, $task]);

        UpdateTaskCommentAction::do($comment, $request);

        return back();
    }


    public function destroyTaskComment(Task $task, Comment $comment)
    {
        Gate::authorize('updateOrDestroy', [$comment, $task]);

        DeleteTaskCommentAction::do($comment);

        return back();
    }
}
