<?php

namespace App\Http\Controllers;

use App\Actions\Auth\SignupAction;
use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use Auth;

class AuthController extends Controller
{
    public function signupView()
    {
        return view('auth.signup');
    }

    public function signup(SignupRequest $request)
    {
        $user = SignupAction::do($request);

        return redirect()->route('users.dashboard', ['user' => $user]);
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            LogAction::do(Auth::user(), ActionStatus::SUCCESS, "User logged in.", Auth::user());
            return redirect(route('users.dashboard', ['user' => Auth::user()]));
        }

        return redirect()->route('login')->withErrors([
            'credentials' => 'Invalid credentials have been provided.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
