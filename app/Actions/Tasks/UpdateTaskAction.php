<?php

namespace App\Actions\Tasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class UpdateTaskAction
{
    public static function do(UpdateTaskRequest $request, Task $task, RedirectResponse $back): RedirectResponse
    {
        // extract new subtasks to an array
        $new_subtasks = CreateTaskAction::extractSubtasks($request->subtasks);

        // check for repeated subtasks between new subtasks
        if (($rep = CreateTaskAction::isRepeated($new_subtasks)) !== null) {
            LogAction::do(Auth::user(), ActionStatus::FAILURE,
                "Failed to update task's subtask. Reason: Subtask $rep has been submitted multiple times.",
                $task, $request->except('_token'));

            return $back->withErrors(['subtasks' => "Subtask $rep has been submitted multiple times."]);
        }

        // check if new subtasks already exist for this task
        if (($rep = self::uniqueSubtasks($task, $new_subtasks)) !== null) {
            LogAction::do(Auth::user(), ActionStatus::FAILURE,
                "Failed to update task's subtask. Reason: Subtask $rep already exists.",
                $task, $request->except('_token'));

            return $back->withErrors(['subtasks' => "Subtask $rep already exists for task."]);
        }

        // task can't be declared as finished if it still has active subtasks
        if (!is_null($request->taskIsDone) && $task->subtasks()->where('is_completed', '0')->exists()) {
            LogAction::do(Auth::user(), ActionStatus::FAILURE,
                "Failed to update task. Reason: Task has unfinished subtasks.",
                $task, $request->except('_token'));

            return $back->withErrors(['finished' => "task has active subtasks."]);
        }

        try {
            DB::transaction(function () use ($task, $request, $new_subtasks) {
                $task->update([
                    'status' => is_null($request->taskIsDone) ? $task->status : ($request->taskIsDone ? 'COMPLETED' : 'ONGOING'),
                    'title' => $request->title ?? $task->title,
                    'description' => $request->description ?? $task->description,
                    'priority' => $request->priority ?? $task->priority,
                    'deadline' => $request->deadline ?? $task->deadline,
                ]);

                $task->subtasks()->createMany(array_map(fn($subtask) => ['title' => $subtask], $new_subtasks));

                $task->users()->sync($request->users);
                $task->categories()->sync($request->categories);
            });
        } catch (Throwable $throwable) {
            LogAction::do(Auth::user(), ActionStatus::FAILURE, "Failed to update task. Reason: " . $throwable->getMessage(),
            $task, $request->except('_token'));

            return $back->withErrors(['update' => "There was an error updating the task."]);
        }

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Task updated.", $task, $request->except('_token'));

        return redirect()->route('tasks.show', ['task' => $task]);
    }

    private static function uniqueSubtasks(Task $task, array $subtasks): ?string
    {
        foreach ($subtasks as $subtask) {
            if ($task->subtasks->where('title', $subtask)->count() != 0) {
                return $subtask;
            }
        }

        return null;
    }
}
