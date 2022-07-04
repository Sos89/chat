<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index()
    {
        $users = User::get();
        return Inertia::render('User/Dashboard', compact('users'));
    }
    public function create(Request $request){
        ChatRoom::create([
            'name' => $request['name']
        ]);
    }
}
