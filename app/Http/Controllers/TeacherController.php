<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Traits\Teacher\ManageCourses;
use App\Traits\Teacher\ManageUnits;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use ManageCourses, ManageUnits;

    public function index() {
        return view('teacher.index');
    }
}
