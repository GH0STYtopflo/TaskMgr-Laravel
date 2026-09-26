<?php

namespace App\Actions\Tasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DeleteTaskAction
{
    public static function do(Task $task): void
    {
        $task->delete();

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Deleted task", Task::class, $task);
    }
}
