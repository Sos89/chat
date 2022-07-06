<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
       return Inertia::render('User/Dashboard', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('User/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return Inertia::render('User/Show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('User/Edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        if (isset($request['photo'])) {
            $user->updateProfilePhoto($request['photo']);
        }
            $user->forceFill([
                'name' => $request['name'],
                'surname' => $request['surname'],
                'gender' => $request['gender'],
            ])->save();
        $users = User::get();
        return Inertia::render('User/Dashboard', compact('users'));
    }


}
