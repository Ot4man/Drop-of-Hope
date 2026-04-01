<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDonorEligibility
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isDonor()) {
            abort(403, 'Unauthorized access. Only donors can perform this action.');
        }

        $profile = $user->donorProfile;

        if (!$profile) {
            return redirect()->route('profile.edit')->with('error', 'Please complete your donor profile first.');
        }

        if (!$profile->evaluateEligibility()) {
            return redirect()->route('donor.not-eligible');
        }

        return $next($request);
    }
}
