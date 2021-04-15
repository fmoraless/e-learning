<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    // Saber si es profesor o si es estudiante y ha comprado el curso, para dar acceso //->
    public function purchaseCourse(User $user, Course $course) {
        $isTeacher = $user->id === $course->user_id;
        $coursePurchased = $course->students->contains($user->id);
        return !$isTeacher && !$coursePurchased;
    }

    //mostrar o no el boton para valorar el curso.
    public function review(User $user, Course $course){
        //Cursos que el estudiante ha comprado.
        $coursePurchased = $course->students->contains($user->id);
        $reviewed = $course->reviews->contains('user_id',$user->id);
        return $coursePurchased && !$reviewed;
    }
}
