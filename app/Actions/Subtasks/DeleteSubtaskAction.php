<?php

namespace App\Actions\Subtasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Subtask;
use App\Models\Task;
use Auth;

class DeleteSubtaskAction
{
    public static function do(Subtask $subtask, Task $task): void
    {
        $subtask->delete();

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Deleted subtask $subtask->title from $task->title",
            Subtask::class);

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Deleted subtask $subtask->title", $task);
    }
}
