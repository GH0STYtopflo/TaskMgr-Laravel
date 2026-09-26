<?php

namespace App\Actions\Tasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Tasks\UpdateTaskStatusRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NonAdminUpdateAction
{
    public static function do(Task $task, UpdateTaskStatusRequest $request, RedirectResponse $back): RedirectResponse
    {
        if (isset($request->task_is_done) && $task->subtasks()->where('is_completed', '0')->exists()) {
            LogAction::do(Auth::user(), ActionStatus::FAILURE, "Failed to update task status. Reason: Task has unfinished subtasks");

            return $back->withErrors(['finished' => "task has active subtasks."]);
        }

        $task->update([
            'status' => $request->task_is_done ? 'COMPLETED' : 'ONGOING',
        ]);

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Updated task status", $task, $request->except('_token'));

        return $back;
    }
}
