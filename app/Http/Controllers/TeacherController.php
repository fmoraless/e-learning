<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index() {
        return view('teacher.index');
    }

    public function courses() {
        $courses = Course::forTeacher();
        return view('teacher.courses.index', compact('courses'));
    }

    public function createCourse() {

    }
}
