<?php

namespace App\Actions\Tasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Tasks\QueryTasksRequest;
use App\Models\Task;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class QueryTasksAction
{
    public static function do(QueryTasksRequest $request, ?BelongsToMany $tasks = null): Collection
    {
        return self::query($tasks ?? Task::query(), $request);
    }

    private static function query(BelongsToMany|Builder $qb, Request $request): Collection
    {
        $tasks = $qb->when($request->plt, function ($query) use ($request) {
            $query->where('priority', '<=', $request->plt);
        })
            ->when($request->pgt, function ($query) use ($request) {
                $query->where('priority', '>=', $request->pgt);
            })
            ->when($request->created_before, function ($query) use ($request) {
                $query->where('tasks.created_at', '<=', $request->created_before);
            })
            ->when($request->created_after, function ($query) use ($request) {
                $query->where('tasks.created_at', '>=', $request->created_after);
            })
            ->when($request->deadline_before, function ($query) use ($request) {
                $query->where('deadline', '<=', $request->deadline_before);
            })
            ->when($request->deadline_after, function ($query) use ($request) {
                $query->where('deadline', '>=', $request->deadline_after);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderByDesc($request->order_by ?? 'created_at')
            ->get();

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Queried tasks", Task::class, $request->except('_token'));

        return $tasks;
    }
}
