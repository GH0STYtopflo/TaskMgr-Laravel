<?php

namespace App\Http\Controllers;

use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\QueryTasksAction;
use App\Actions\Tasks\UpdateTaskAction;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\QueryTasksRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(QueryTasksRequest $request)
    {
        $tasks = QueryTasksAction::do($request);

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('tasks.create', ['users' => $users, 'categories' => $categories]);
    }

    public function store(CreateTaskRequest $request)
    {
        // redirect back if necessary
        $back = back();

        return CreateTaskAction::do($request, $back);
    }

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

    public function update(UpdateTaskRequest $request, Task $task)
    {
        return UpdateTaskAction::do($request, $task, back());
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function nonAdminUpdate($user, Task $task, Request $request)
    {
        Gate::authorize('non-admin-update-and-show', $task);

        if (isset($request->taskIsDone) && $task->subtasks()->where('is_completed', '0')->exists()) {
            return redirect()->back()->withErrors(['finished' => "task has active subtasks."]);
        }

        $task->update([
            'status' => $request->taskIsDone ? 'COMPLETED' : 'ONGOING',
        ]);

        return back();
    }

    public function nonAdminShow($user, Task $task)
    {
        Gate::authorize('non-admin-update-and-show', $task);

        $comments = $task->comments;

        return view('users.non_admin.tasks.show', [
            'task' => $task,
            'comments' => $comments,
        ]);
    }
}
