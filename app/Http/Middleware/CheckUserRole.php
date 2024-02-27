<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            $roleNames = explode(',', $role);
            foreach ($roleNames as $roleName) {
                if (Gate::allows('role', $roleName)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'Unauthorized.');
    }
}
