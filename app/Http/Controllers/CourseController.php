<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::filtered();
        return view('learning.courses.index', compact('courses'));
        //dd(session('search[courses]'));
    }

    public function search() {
        session()->remove('search[courses]');
        if (request('search')){
            session()->put('search[courses]', request('search'));
            session()->save();
        }
        return redirect(route('courses.index'));
    }

    public function show(Course $course) {
        $course->load("units", "students", "reviews");
        dd($course);
        return view('learning.courses.show', compact('course'));
    }
}
