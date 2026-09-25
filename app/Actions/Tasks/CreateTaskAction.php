<?php

namespace App\Actions\Tasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateTaskAction
{
    public static function do(CreateTaskRequest $request, RedirectResponse $back): RedirectResponse
    {
        // extract subtask titles into an array
        $subtasks = self::extractSubtasks($request->subtasks);

        // verify that the titles do not contain repeated values
        if (($rep = self::isRepeated($subtasks)) !== null) {
            LogAction::do(Auth::user(), ActionStatus::FAILURE,
                "Failed to create task. Reason: Subtask $rep has been submitted multiple times.",
                Task::class, $request->except('_token'));

            return $back->withErrors(['subtasks' => "Subtask $rep has been submitted multiple times."]);
        }

        $task = null;

        try {
            DB::transaction(function () use ($request, $subtasks, &$task) {
                $task = Task::create(
                    $request->except('subtasks', '_token', 'users', 'categories') + ['status' => 'ONGOING']
                );

                $task->subtasks()->createMany(array_map(fn($subtask) => ['title' => $subtask], $subtasks));
                $task->categories()->attach($request->categories);
                $task->users()->attach($request->users);
            });
        } catch (Throwable $throwable) {
            LogAction::do(Auth::user(), ActionStatus::FAILURE, "Failed to create task. Reason: " . $throwable->getMessage(),
            Task::class, $request->except('_token'));

            return $back->withErrors(['task' => 'There was an error submitting your task.']);
        }

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Created task.", $task, $request->except('_token'));

        return redirect()->route('tasks.index');
    }

    public static function extractSubtasks(?string $subs): array
    {
        if (is_null($subs)) {
            return [];
        }

        $subs = explode("\r\n", $subs);

        return array_map(fn($item) => trim($item), $subs);
    }

    public static function isRepeated(array $titles): ?string
    {
        for ($i = 0; $i < count($titles) - 1; $i++) {
            for ($j = $i + 1; $j < count($titles); $j++) {
                if ($titles[$i] === $titles[$j]) {
                    return $titles[$i];
                }
            }
        }

        return null;
    }
}
