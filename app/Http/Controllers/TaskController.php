<?php

namespace App\Http\Controllers;

use App\Actions\Log\LogAction;
use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\DeleteTaskAction;
use App\Actions\Tasks\NonAdminUpdateAction;
use App\Actions\Tasks\QueryTasksAction;
use App\Actions\Tasks\UpdateTaskAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\QueryTasksRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskStatusRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Auth;
use Gate;

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
        $comments = $task->comments;

        LogAction::do(\Auth::user(), ActionStatus::SUCCESS, "Viewed task", Task::class, $task);

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
        DeleteTaskAction::do($task);

        return redirect()->route('tasks.index');
    }

    public function nonAdminUpdate($user, Task $task, UpdateTaskStatusRequest $request)
    {
        Gate::authorize('nonAdminUpdateAndShow', $task);

        $back = back();

        return NonAdminUpdateAction::do($task, $request, $back);
    }

    public function nonAdminShow($user, Task $task)
    {
        Gate::authorize('nonAdminUpdateAndShow', $task);

        $comments = $task->comments;

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Viewed task", $task);

        return view('users.non_admin.tasks.show', [
            'task' => $task,
            'comments' => $comments,
        ]);
    }
}
