<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create(Request $request){
        ChatRoom::create([
            'name' => $request['name']
        ]);
    }
}
