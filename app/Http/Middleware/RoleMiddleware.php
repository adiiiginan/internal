<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Usage in routes:
     *   Route::get(...)->middleware('role:admin');
     *   Route::get(...)->middleware('role:admin,superadmin');
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! Auth::check()) {
            // Not authenticated; let the auth middleware handle redirect if used,
            // but in case it's used alone, redirect to login.
            return redirect()->route('login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // If roles are passed as a single comma-separated string, split it.
        if (count($roles) === 1 && strpos($roles[0], ',') !== false) {
            $roles = array_map('trim', explode(',', $roles[0]));
        }

        // Mapping numeric role IDs (session-style) to role strings used on the User model
        $numericToString = [
            1 => 'admin',
            2 => 'sales',
            3 => 'gudang',
            4 => 'finance',
            5 => 'superadmin',
        ];

        // Allow if user has any of the roles (accepts role strings or numeric ids via session)
        foreach ($roles as $role) {
            // If role passed is numeric (e.g., '2'), convert to string if possible
            if (ctype_digit((string) $role)) {
                $roleInt = (int) $role;
                $role = $numericToString[$roleInt] ?? $role;
            }

            // Check against the authenticated user's role (string)
            if ($user->hasRole($role)) {
                return $next($request);
            }

            // Also allow if a session-based numeric role exists and maps to the role string
            if (session()->has('user_role')) {
                $sessionRole = session('user_role');
                $sessionRoleStr = is_numeric($sessionRole) ? ($numericToString[(int) $sessionRole] ?? null) : $sessionRole;
                if ($sessionRoleStr && $sessionRoleStr === $role) {
                    return $next($request);
                }
            }
        }

        // Unauthorized
        abort(403, 'Unauthorized');
    }
}
