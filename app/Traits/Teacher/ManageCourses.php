<?php
namespace App\Traits\Teacher;

use App\Helpers\Uploader;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Unit;
use DB;

trait ManageCourses {

    public function courses() {
        $courses = Course::forTeacher();
        return view('teacher.courses.index', compact('courses'));
    }

    public function createCourse(CourseRequest $request) {
        $course = New Course;
        $title = __("Crear nuevo curso");
        $textButton = __("Crear curso");
        $options = ['route' => [
            'teacher.courses.store'], 'files' => true
        ];
        return view(
            'teacher.courses.create',
            compact('title', 'course', 'options', 'textButton'));
    }

    public function editCourse(Course $course) {
        $course->load("units");
        $title = __("Editar curso :course", ["course" => $course->title]);
        $textButton = __("Actualizar curso");
        $options = ['route' => [
            'teacher.courses.update', ['course' => $course]], 'files' => true
        ];
        $update = true;
        return view(
            'teacher.courses.edit',
            compact('title', 'course', 'options', 'textButton', 'update'));
    }

    public function storeCourse(CourseRequest $request) {
        try {
            DB::beginTransaction();

            $file = null;
            if ($request->hasFile('picture')) {
                $file = Uploader::uploadFile('picture', 'courses');
            }

            $course = Course::create($this->courseInput($file));
            $course->categories()->sync(request("categories"));

            DB::commit();
            session()->flash("message", ["success", __("Curso creado correctamente")]);
            return redirect(route('teacher.courses.edit', ['course' => $course]));

        }catch(\Throwable $exception) {
            
            session()->flash("message", ["danger", $exception->getMessage()]);
            return back();
        }
    }

    public function updateCourse(CourseRequest $request,Course $course) {
        try {
            DB::beginTransaction();

            $file = $course->picture;
            if ($request->hasFile('picture')) {
                if ($course->picture) {
                    Uploader::removeFile("courses", $course->picture);
                }
                $file = Uploader::uploadFile('picture', 'courses');
            }
            $course->fill($this->courseInput($file, $course->featured))->save();
            $course->categories()->sync(request("categories"));

            $this->updateOrderedUnits();

            DB::commit();
            session()->flash("message", ["success", __("Curso actualizado correctamente")]);
            return back();

        }catch(\Throwable $exception) {
            DB::rollBack();
            session()->flash("message", ["danger", $exception->getMessage()]);
            return back();
        }
    }

    public function courseInput(string $file = null, bool $featured = false): array {
        return [
            "title" => request("title"),
            "description" => request("description"),
            "price" => request("price"),
            "picture" => $file,
            "featured" => $featured
        ];
    }
    public function updateOrderedUnits() {
        if (request("orderedUnits")) {
            $data = json_decode(request("orderedUnits"));
            foreach($data as $unit) {
                Unit::whereId($unit->id)->update(["order" => $unit->order]);
            }
        }
    }
}
