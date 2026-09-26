<?php

namespace App\Actions\Comments;

use App\Actions\Action;
use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Comments\QueryCommentsRequest;
use App\Models\Comment;
use Illuminate\Support\Collection;

class QueryCommentsAction implements Action
{
    public static function do(QueryCommentsRequest $request): Collection
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

        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Queried comments.",
            Comment::class, $request->except('_token'));


        return $comments;
    }

}
