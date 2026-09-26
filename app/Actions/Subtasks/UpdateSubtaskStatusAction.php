<?php

namespace App\Actions\Subtasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Subtasks\UpdateSubtaskStatusRequest;
use App\Models\Subtask;
use Auth;
use Illuminate\Http\RedirectResponse;

class UpdateSubtaskStatusAction
{
    public static function do(Subtask $subtask, UpdateSubtaskStatusRequest $request, RedirectResponse $back): RedirectResponse
    {
        if (
            $subtask->task->status == "COMPLETED" && !request()->exists('is_done')
        ) {
            LogAction::do(Auth::user(), ActionStatus::FAILURE, "Failed to update subtask. Reason: The correlating task is already finished.");

            return $back->withErrors(['subtasks' => 'This task is already declared as finished.']);
        }

        $subtask->update(['is_completed' => $request->exists('is_done')]);

        return $back;
    }
}
