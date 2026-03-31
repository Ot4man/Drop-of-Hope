<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Only enforce donor profile completion for registered Donors
        if ($user && $user->isDonor()) {
            if (!$user->profile || !$user->profile->available || !$user->profile->blood_type) {
                return redirect()->route('profile.edit')->with('warning', 'Complete your profile first');
            }
        }

        return $next($request);
    }
}
