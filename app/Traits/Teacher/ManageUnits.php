<?php
namespace App\Traits\Teacher;

use App\Helpers\Uploader;
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
        $file = null;
        if ($request->hasFile("file")){
            $file = Uploader::uploadFile("file", "units");
        }
        $unit = Unit::create([
           "course_id" => $request->input("course_id"),
           "title" => $request->input("title"),
           "content" => $request->input("content"),
           "file" => $file,
           "unit_type" => $request->input("unit_type"),
           "unit_time" => $request->input("unit_time"),
        ]);

        session()->flash(
            "message", [
                "success",
                __("Unidad creada satisfactoriamente")
            ]
        );
        return redirect(route('teacher.units'));
    }
}
