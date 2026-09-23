<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function Laravel\Prompts\task;

class MiscController extends Controller
{
    public function dashboard(Request $request)
    {
        return Auth::user()->is_admin ?
            view('users.admin.dashboard')
                :
            view('users.non_admin.dashboard', ['tasks' => Auth::user()->tasks]);
    }
}
