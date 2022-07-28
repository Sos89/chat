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
        return Inertia::render('User/index', compact('users'));
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        ChatRoom::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'created_at'=>NOW(),
            'updated_at'=>NOW(),
        ]);
        return Inertia::render('User/index');

    }
}
