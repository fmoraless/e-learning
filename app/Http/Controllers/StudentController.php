<?php

namespace App\Http\Controllers;

use App\Traits\ManageCart;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use ManageCart;

    public function index() {
        return view('student.index');
    }

}
