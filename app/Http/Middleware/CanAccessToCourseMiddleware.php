<?php

namespace App\Http\Middleware;

use Closure;

class CanAccessToCourseMiddleware
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
        $blockAccess = false;
        if (!auth()->check()) $blockAccess = true;
        $course = $request->route()->parameter('course');
        //comprobar si es profesor. Usuario identificado es igual al usuario que creo el curso.
        $isTeacher = auth()->id() === $course->user_id;
        //comprobar si es estudiante. Si el usuario identificado está dentro de los estudiantes del curso.
        $coursePurchased = $course->students->contains(auth()->id());
        //Si no es profesor y no ha comprado el curso, entonces bloquear acceso.
        if (!$isTeacher && !$coursePurchased) $blockAccess = true;

        if ($blockAccess) {
            session()->flash("message", ["danger", __("No puedes acceder a este curso.")]);
            return redirect(route('courses.show', ["course" => $course]));
        }

        return $next($request);
    }
}
