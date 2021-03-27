<?php
namespace App\Traits\Teacher;

use App\Http\Requests\UnitRequest;
use App\Models\Course;
use App\Models\Unit;

trait ManageUnits {

    public function units() {
        $units = Unit::forTeacher();
        return view('teacher.units.index', compact('units'));
    }

    public function createUnit() {
        $title = __("Nueva unidad");
        $textButton = __("Crear unidad");
        $courses = Course::forTeacher();
        $unit = new Unit;
        $options = ['route' => ['teacher.units.store'], 'files' => true];
        return view('teacher.units.create', compact('title', 'courses', 'unit', 'options', 'textButton'));
    }

    public function storeUnit(UnitRequest $request) {

    }
}
