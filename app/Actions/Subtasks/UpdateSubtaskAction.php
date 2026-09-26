<?php

namespace App\Actions\Subtasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Subtasks\UpdateSubtaskRequest;
use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;

class UpdateSubtaskAction
{
    public static function do(Task $task, Subtask $subtask, UpdateSubtaskRequest $request, RedirectResponse $back): RedirectResponse
    {
        if (
            $task->subtasks()->where('id','!=' , $subtask->id)
            ->where('title', $request->title)->exists()
        ) {

            LogAction::do(\Auth::user(), ActionStatus::FAILURE, "Failed to Update subtask. Reason: Subtasks with title '$request->title' already exists.",
            $subtask, $request->except('_token'));

            return $back->withErrors(['subtasks' => 'Subtask already exists.']);
        }

        if (
            $subtask->task->status == "COMPLETED" && !request()->exists('is_done')
        ) {
            LogAction::do(\Auth::user(), ActionStatus::FAILURE, "Failed to update subtask. Reason: The correlating task is already finished.");

            return $back->withErrors(['subtasks' => 'This task is already declared as finished.']);
        }

        $subtask->update(['title' => $request->title ?? $subtask->title, 'is_completed' => $request->exists('is_done')]);

        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Subtask '$request->title' updated.", $subtask,
        $request->except('_token'));

        return $back;
    }
}
