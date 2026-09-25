<?php

namespace App\Http\Controllers;

use App\Actions\Tasks\QueryTasksAction;
use App\Actions\Users\QueryUsersAction;
use App\Actions\Users\UpdateUserAction;
use App\Http\Requests\Tasks\QueryTasksRequest;
use App\Http\Requests\Users\QueryUsersRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Gate;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(QueryUsersRequest $request)
    {
        $users = QueryUsersAction::do($request);

        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        Gate::authorize('vudd', $user);

        return view('users.show', ['user' => $user]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        Gate::authorize('vudd', $user);

        UpdateUserAction::do($user, $request);

        if ($user->is(Auth::user())) {
            Auth::logout();
            return redirect()->route('login');
        }

        return back();
    }

    public function destroy(User $user)
    {
        Gate::authorize('vudd', $user);

        $user->delete();
    }

    public function dashboard(User $user, QueryTasksRequest $request)
    {
        Gate::authorize('vudd', $user);

        if ($user->is_admin) {
            return view('users.admin.dashboard');
        } else {
            return view('users.non_admin.dashboard', ['tasks' => QueryTasksAction::do($request, $user->tasks())]);
        }
    }
}
