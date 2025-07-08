<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     * Allow only users with is_admin = true
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || !$user->is_admin) {
            // Return JSON error response for API routes
            return response()->json(['message' => 'Unauthorized, admin only'], 403);
            // Or use abort(403) if you want a default HTML error page
            // abort(403, 'Unauthorized, admin only');
        }

        return $next($request);
    }
}
