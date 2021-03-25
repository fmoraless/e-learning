<?php

namespace App\Http\Middleware;

use Closure;
use function Faker\Provider\pt_BR\check_digit;

class TeacherMiddleware
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
        if (!auth()->check()) {
            return redirect(route("welcome"));
        }
        if (!auth()->user()->isTeacher()) {
            return redirect(route("welcome"));
        }
        return $next($request);
    }
}
