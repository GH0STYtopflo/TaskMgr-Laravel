<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\json;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->username, function ($query, $username) {
                return $query->whereUsername($username);
            })->when($request->id, function ($query, $id) {
                $query->where('id', '=', $id);
            })->when($request->before, function ($query, $before) {
                $query->where('created_at', '<=', $before);
            })->when($request->after, function ($query, $after) {
                $query->where('created_at', '>=', $after);
            })
        ->get();

        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $user->email = $request->email ?? $user->email;

        $user->username = $request->username ?? $user->username;

        if (!is_null($request->new_password)) {
            $user->password = $request->new_password;
        }

        $user->save();

        if ($user->is(Auth::user())) {
            Auth::logout();
            return redirect()->route('login');
        }

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

    public function dashboard(User $user)
    {
        return $user->is_admin ?
            view('users.admin.dashboard')
            :
            view('users.non_admin.dashboard', ['tasks' => $user->tasks]);
    }
}
