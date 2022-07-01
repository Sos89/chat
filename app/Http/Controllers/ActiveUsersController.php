<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ActiveUsersController extends Controller
{

    public function getUsers()
    {
       $users = User::get();
       return $users;
    }
}
