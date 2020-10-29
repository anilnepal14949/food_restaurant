<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where('is_admin', '!=', 1)->get();
        $activeMenu = 'user';
        $activeSubMenu = 'all-users';

        return view('admin.user.index', compact('users', 'activeMenu', 'activeSubMenu'));
    }
}
