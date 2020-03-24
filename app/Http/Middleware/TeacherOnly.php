<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class TeacherOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user()->hasRole('docente')) {
        abort(403, "No tienes autorización para ingresar.");
        }  

        return $next($request);
    }
}
