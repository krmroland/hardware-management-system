<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\PasswordChangeRequest;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return view('profiles.show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User                $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordChangeRequest $request)
    {
        $user = auth()->user();

        $user->update(['password' => bcrypt($request->newPassword)]);

        flash('Password was changed successfully');

        return back();
    }
}
