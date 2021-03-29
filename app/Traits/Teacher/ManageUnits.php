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
        $unit = Unit::create($this->unitInput($file));

        session()->flash(
            "message", [
                "success",
                __("Unidad creada satisfactoriamente")
            ]
        );
        return redirect(route('teacher.units'));
    }

    public function editUnit(Unit $unit) {
        //dd($unit);
        $title = __("Editar unidad :unit", ["unit" => $unit->title]);
        $textButton = __("Actualizar unidad");
        $courses = Course::forTeacher();
        $options = ['route' => [
            'teacher.units.update', ['unit' => $unit]], 'files' => true
        ];
        $update = true;
        return view(
            'teacher.units.edit',
            compact('title', 'courses', 'unit', 'options', 'textButton', 'update'));
    }

    public function updateUnit(UnitRequest $request, Unit $unit) {
        $file = $unit->file;
        if ($request->hasFile('file')){
            if ($unit->file){
                Uploader::removeFile("units", $unit->file);
            }
            $file = Uploader::uploadFile("file", "units");
        }
        $unit->fill($this->unitInput($file))->save();

        session()->flash(
            "message", [
                "success",
                __("Unidad actualizada satisfactoriamente")
            ]
        );
        return redirect(route('teacher.units'));
    }

    public function destroyUnit(Unit $unit) {
        try {
            if (request()->ajax()) {
                if ($unit->file){
                    Uploader::removeFile("units", $unit->file);
                }
                $unit->delete();
                session()->flash("message", ["success", __("La unidad :id del curso :course ha sido eliminada correctamente", [
                    "id" => $unit->id,
                    "course" => $unit->course->title
                ])]);
            }else{
                abort(401);
            }

            /**/
        } catch (\Exception $exception) {
            session()->flash("message", ["danger", $exception->getMessage()]);
           //return response()->json($exception->getMessage());
        }
    }

    public function unitInput(string $file = null): array {
        return [
            "course_id" => request("course_id"),
            "title" => request("title"),
            "content" => request("content"),
            "file" => $file,
            "unit_type" => request("unit_type"),
            "unit_time" => request("unit_time"),
            "free" => request("free")
        ];
    }
}
