<?php

namespace App\Http\Controllers;

use App\User;
use App\Branch;
use Illuminate\Http\Request;

class BranchesUserController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('admin')->except('update');
    }

    public function update(Branch $branch)
    {
        auth()->user()->activateBranch($branch);

        flash('All went well');
    }

    public function destroy(Branch $branch, User $user)
    {
        cache()->flush();

        return $branch->users()->detach($user);
    }

    public function store(Request $request, Branch $branch)
    {
        $request->validate($branch->addingUserRules());

        $branch->users()->attach($request->user_id);

        cache()->flush();

        return $branch->users()->get();
    }
}
