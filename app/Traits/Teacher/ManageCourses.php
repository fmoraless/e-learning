<?php
namespace App\Traits\Teacher;

use App\Models\Course;

trait ManageCourses {

    public function courses() {
        $courses = Course::forTeacher();
        return view('teacher.courses.index', compact('courses'));
    }

    public function createCourse() {

    }
}
