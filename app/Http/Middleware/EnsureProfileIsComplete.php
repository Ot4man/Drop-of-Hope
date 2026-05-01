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

       
        if ($user && $user->isDonor()) {
            if (!$user->donorProfile || !$user->donorProfile->blood_type) {
                return redirect()->route('profile.edit')->with('warning', 'Complete your profile first');
            }
        }

        return $next($request);
    }
}
