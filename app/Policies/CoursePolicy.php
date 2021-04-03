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
}
