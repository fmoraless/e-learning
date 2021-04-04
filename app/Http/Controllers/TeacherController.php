<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Course;
use App\Traits\Teacher\ManageCoupons;
use App\Traits\Teacher\ManageCourses;
use App\Traits\Teacher\ManageUnits;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use ManageCourses, ManageUnits, ManageCoupons;

    public function index() {
        return view('teacher.index');
    }


}
