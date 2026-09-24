<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signupView()
    {
        return view('auth.signup');
    }

    public function signup(SignupRequest $request)
    {
        $user = User::make(
            $request->except('_token', 'password')
        );
        $user->password = $request->password;
        $user->save();

        Auth::login($user);


        return redirect()->route('users.dashboard', ['user' => $user]);
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
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
