<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
class UserController extends Controller
{
//    public function __construct()
//    {
//        $this->authorizeResource(User::class);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
        ]);
        $user->update($request->only('name', 'surname', 'gender'));
        return back();
    }
/**
//* @param  mixed  $user
//* @param  array  $input
//* @return void
//*/
//    public function update($user, array $input)
//    {
////        dd(2);
//        Validator::make($input, [
//            'name' => ['required', 'string', 'max:255'],
//            'surname' => ['required', 'string', 'max:255'],
//            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
//        ])->validateWithBag('updateProfileInformation');
//
//        if (isset($input['photo'])) {
//            $user->updateProfilePhoto($input['photo']);
//        }
//
//        if ($input['email'] !== $user->email &&
//            $user instanceof MustVerifyEmail) {
//            $this->updateVerifiedUser($user, $input);
//        } else {
//            $user->forceFill([
//                'name' => $input['name'],
//                'surname' => $input['surname'],
//                'gender' => $input['gender'],
//            ])->save();
//        }
//    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $user = User::find($id);
//        $user->deleteProfilePhoto();
//        $user->tokens->each->delete();
//        $user->delete();
    }
}
