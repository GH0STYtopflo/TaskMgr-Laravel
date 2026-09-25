<?php

namespace App\Actions\Subtasks;

use App\Http\Requests\Subtasks\UpdateSubtaskRequest;
use App\Models\Subtask;
use Illuminate\Http\RedirectResponse;

class UpdateSubtaskAction
{
    public static function do($task, Subtask $subtask, UpdateSubtaskRequest $request, RedirectResponse $back): RedirectResponse
    {
        if (Subtask::where('id','!=' , $subtask->id)
            ->where('title', $request->title)->exists()) {
            return $back->withErrors(['subtasks' => 'Subtask already exists.']);
        }

        $subtask->update(['title' => $request->title ?? $subtask->title, 'is_completed' => $request->exists('is_done')]);

        return $back;
    }
}
