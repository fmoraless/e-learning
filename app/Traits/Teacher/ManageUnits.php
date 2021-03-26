<?php
namespace App\Traits\Teacher;

use App\Models\Course;
use App\Models\Unit;

trait ManageUnits {

    public function units() {
        $units = Unit::forTeacher();
        return view('teacher.units.index', compact('units'));
    }

    public function createUnit() {

    }
}
