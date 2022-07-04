<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function index()
    {
        $role=Auth::user()->role;

        if ($role == '1')
        {
            $users = User::get();
            return Inertia::render('User/Dashboard', compact('users'));
        }
        else{
            return Inertia::render('Dashboard');
        }
    }
}
