<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;

class MiscController extends Controller
{
    public function dashboard()
    {
        return Auth::user()->is_admin ?
            view('user.admin.dashboard')
                :
            view('user.non_admin.dashboard', ['tasks' => Auth::user()->tasks]);
    }
}
