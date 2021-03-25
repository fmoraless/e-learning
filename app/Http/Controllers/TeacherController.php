<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Traits\Teacher\ManageCourses;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use ManageCourses;
    
    public function index() {
        return view('teacher.index');
    }
}
