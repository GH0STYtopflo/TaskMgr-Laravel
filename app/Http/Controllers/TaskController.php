<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('tasks.create', ['users' => $users, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        // extract subtask titles into an array
        $subtasks = self::extractSubtasks($request->subtasks);

        //verify that the titles do not contain repeated values
        if (($rep = self::isRepeated($subtasks)) !== null) {
            return redirect()->back()->withErrors(['subtasks' => "Subtask $rep has been submitted multiple times."]);
        }

        $task = Task::create(
            $request->except('subtasks', '_token', 'users', 'categories') + ['status' => $request->users > 0 ? 'ONGOING' : 'SUBMITTED']
        );

        $task->subtasks()->createMany(array_map(fn ($subtask) => ['title' => $subtask], $subtasks));
        $task->categories()->attach($request->categories);
        $task->users()->attach($request->users);

        return redirect('/tasks');
    }

    private static function extractSubtasks(?string $subs): array
    {
        if (is_null($subs)) {
            return [];
        }

        $subs = explode("\r\n", $subs);

        return array_map(fn($item) => trim($item), $subs);
    }

    private static function isRepeated(array $titles): ?string
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

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $categories = Category::all();
        $users = User::all();
        $comments = Comment::all();

        return view('tasks.show', [
            'task' => $task,
            'categories' => $categories,
            'users' => $users,
            'comments' => $comments
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // extra validations
        $subtasks = self::extractSubtasks($request->subtasks);
        if (($rep = self::isRepeated($subtasks)) !== null) {
            return redirect()->back()->withErrors(['subtasks' => "Subtask $rep has been submitted multiple times."]);
        }

        if (($rep = self::uniqueSubtasks($task, $subtasks)) !== null) {
            return redirect()->back()->withErrors(['subtasks' => "Subtask $rep has been submitted multiple times."]);
        }

        if (isset($request->taskIsDone) && $task->subtasks()->where('is_completed', '0')->count() > 0) {
            return redirect()->back()->withErrors(['finished' => "task has active subtasks."]);
        }

        $task->update([
            'status' => $request->taskIsDone ? 'COMPLETED' : 'ONGOING',
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
        ]);

        $task->subtasks()->createMany(array_map(fn ($subtask) => ['title' => $subtask], $subtasks));

        $existingSubs = $request->existingSubs ?? [];

        foreach ($existingSubs as $i => $existingSub) {
            Subtask::find($i)->update([
                'title' => $existingSub,
                'is_completed' => array_key_exists($i, $request->subIsdone) ? 1 : 0,
            ]);
        }

        $task->users()->sync($request->users);
        $task->categories()->sync($request->categories);

        return redirect('/tasks/' . $task->id);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }

    public function nonAdminUpdate($user, Task $task, Request $request)
    {
        if (isset($request->taskIsDone) && $task->subtasks()->where('is_completed', '0')->count() > 0) {
            return redirect()->back()->withErrors(['finished' => "task has active subtasks."]);
        }

        foreach ($task->subtasks as $subtask) {
            $subtask->update([
                'is_completed' => array_key_exists($subtask->id, $request->subIsdone),
            ]);
        }

        $task->update([
            'status' => $request->taskIsDone ? 'COMPLETED' : 'ONGOING',
        ]);

        return back();
    }

    public function nonAdminShow($user, Task $task)
    {
        $comments = $task->comments;

        return view('users.non_admin.tasks.show', [
            'task' => $task,
            'comments' => $comments,
        ]);
    }

    // Task comments ---------------------------------------------
    public function storeTaskComment(Task $task ,Request $request)
    {
        $task->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back();
    }


    public function updateTaskComment($task, Comment $comment, Request $request)
    {
        if ($comment->body == $request->body) {
            return back();
        }

        $comment->update([
            'body' => $request->body,
        ]);

        return back();
    }


    public function destroyTaskComment($task, Comment $comment)
    {
        $comment->delete();

        return back();
    }
    //-----------------------------------------------------------------
}
