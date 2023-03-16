<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$role): Response
    {
        if (! $request->user()->authorizeRoles($role)) {
            return redirect('api/login');
            //abort(403, "No tienes autorización para ingresar.");
        }
    
        return $next($request);
    }
}
