<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHospitalVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isHospital()) {
            abort(403, 'Unauthorized access. Only hospitals can perform this action.');
        }

        $profile = $user->hospitalProfile;

        if (!$profile) {
            return redirect()->route('profile.edit')->with('error', 'Please complete your hospital profile first.');
        }

        if (!$profile->is_verified) {
            return redirect()->route('hospital.pending-verification');
        }

        return $next($request);
    }
}
