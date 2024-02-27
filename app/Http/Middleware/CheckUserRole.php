<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            $roleNames = explode(',', $role);
            foreach ($roleNames as $roleName) {
                if (Gate::allows('role', $roleName)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'Forbidden');
    }
}
