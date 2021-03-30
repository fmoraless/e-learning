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

    public function editCourse(Course $course) {
        $course->load("units");
        $title = __("Editar curso :course", ["course" => $course->title]);
        $textButton = __("Actualizar curso");
        $options = ['route' => [
            'teacher.courses.update', ['course' => $course]], 'files' => true
        ];
        $update = true;
        return view(
            'teacher.courses.edit',
            compact('title', 'course', 'options', 'textButton', 'update'));
    }
}
