<?php

namespace App\Http\Middleware;

use Closure;
use App\Branch;
use Illuminate\Support\Facades\Auth;

class BranchFilter
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (optional(Auth::user())->isAdmin()) {
            if (!Branch::hasSome()) {
                flash('Please Add atleast a branch to start', 'danger');

                return redirect()->route('branches.create');
            }

            return $next($request);
        }

        if (optional(Auth::user())->hasAtleastABranch()) {
            return $next($request);
        }

        Auth::logout();

        session()->flash('branch-error', 'No Branch has been assigned to this account.. 
            Please ask the admin to assign you a branch');

        return redirect()->route('login');
    }
}
