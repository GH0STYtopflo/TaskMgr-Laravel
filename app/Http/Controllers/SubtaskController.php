<?php

namespace App\Http\Controllers;

use App\Actions\Subtasks\UpdateSubtaskAction;
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

    public function destroyTaskSubtask($task, Subtask $subtask)
    {
        $subtask->delete();

        return back();
    }

    public function updateSubtaskStatus($user, $task, Subtask $subtask, UpdateSubtaskStatusRequest $request)
    {
        Gate::authorize('updateSubStatus', $subtask);

        $subtask->update(['is_completed' => $request->exists('is_done')]);

        return back();
    }
}
