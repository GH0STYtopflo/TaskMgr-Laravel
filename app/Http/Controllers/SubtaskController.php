<?php

namespace App\Http\Controllers;

use App\Actions\Subtasks\DeleteSubtaskAction;
use App\Actions\Subtasks\UpdateSubtaskAction;
use App\Actions\Subtasks\UpdateSubtaskStatusAction;
use App\Http\Requests\Subtasks\UpdateSubtaskRequest;
use App\Http\Requests\Subtasks\UpdateSubtaskStatusRequest;
use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class SubtaskController extends Controller
{

    public function updateTaskSubtask(Task $task, Subtask $subtask, UpdateSubtaskRequest $request)
    {
        return UpdateSubtaskAction::do($task, $subtask, $request, back());
    }

    public function destroyTaskSubtask(Task $task, Subtask $subtask)
    {
        DeleteSubtaskAction::do($subtask, $task);

        return back();
    }

    public function updateSubtaskStatus($user, $task, Subtask $subtask, UpdateSubtaskStatusRequest $request)
    {
        Gate::authorize('updateSubStatus', $subtask);

        $back = back();

        return UpdateSubtaskStatusAction::do($subtask, $request, $back);
    }
}
