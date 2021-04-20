<?php

namespace App\Http\Controllers;

use App\Traits\ManageCart;
use App\Traits\Student\ManageCourses;
use App\Traits\Student\ManageOrders;
use App\Traits\Student\ManageWishLists;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use ManageCart, ManageCourses, ManageOrders, ManageWishLists;

    public function index() {
        return view('student.index');
    }

}
