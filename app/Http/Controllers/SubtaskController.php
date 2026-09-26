<?php

namespace App\Http\Controllers;

use App\Actions\Log\LogAction;
use App\Actions\Subtasks\UpdateSubtaskAction;
use App\Enums\ActionStatus;
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
        $subtask->delete();

        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Deleted subtask {$subtask->title} from {$task->title}",
        Subtask::class);

        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Deleted subtask {$subtask->title}", $task);

        return back();
    }

    public function updateSubtaskStatus($user, $task, Subtask $subtask, UpdateSubtaskStatusRequest $request)
    {
        Gate::authorize('updateSubStatus', $subtask);

        if (
            $subtask->task->status == "COMPLETED" && !request()->exists('is_done')
        ) {
            LogAction::do(\Auth::user(), ActionStatus::FAILURE, "Failed to update subtask. Reason: The correlating task is already finished.");

            return back()->withErrors(['subtasks' => 'This task is already declared as finished.']);
        }

        $subtask->update(['is_completed' => $request->exists('is_done')]);

        return back();
    }
}
