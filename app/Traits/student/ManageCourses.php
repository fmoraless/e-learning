<?php
namespace App\Traits\Student;



trait ManageCourses {

    public function courses() {
        $courses = auth()->user()->purchasedCourses();
        return view('student.courses.index', compact('courses'));
    }
}
