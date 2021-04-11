<?php

namespace App\Http\Controllers;

use App\Traits\ManageCart;
use App\Traits\Student\ManageCourses;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use ManageCart, ManageCourses;

    public function index() {
        return view('student.index');
    }

}
