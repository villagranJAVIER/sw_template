<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Allows
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $toBeChecked = array_slice(func_get_args(), 2);
        $module      = $toBeChecked[0];
        // TODO - Is super admin
        if(auth()->user()->hasRole('Admin'))
            return $next($request);

        // TODO - By Option (Create, read, update, delete)
        if (isset($toBeChecked[1]))
        {
            $option = $toBeChecked[1];
            try {
                if (auth()->user()->hasPermissionTo("{$module}.{$option}"));
                    return $next($request);
            }catch (\Exception $exception) {
                abort(403);
            }
        }
        // TODO - All options
        else {
            try {
                if (auth()->user()->hasPermissionTo(["{$module}.read", "{$module}.create", "{$module}.update", "{$module}.delete"]));
                    return $next($request);
            }catch (\Exception $exception) {
                abort(403);
            }
        }
        // TODO - No allowed
        abort(403);
    }
}
