<?php

namespace App\Http\Controllers;

use App\Helpers\Currency;
use App\Models\Course;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::filtered();
        return view('learning.courses.index', compact('courses'));
        //dd(session('search[courses]'));
    }

    public function search() {
        session()->remove('search[courses]');
        if (request('search')){
            session()->put('search[courses]', request('search'));
            session()->save();
        }
        return redirect(route('courses.index'));
    }

    public function show(Course $course) {
        $course->load("units", "students", "reviews.author");
        /*$amount = 12.5;
        dd(Currency::formatCurrency($amount));*/
        return view('learning.courses.show', compact('course'));
    }

    public function learn(Course $course) {
        $course->load("units");
        return view('learning.courses.learn', compact('course'));
    }

    public function createReview(Course $course){
        return view('learning.courses.reviews.form',compact('course'));
    }

    public function storeReview(Course $course){
        $reviewed = $course->reviews->contains('user_id', '=',auth()->id());
        if ($reviewed){
            return redirect(route('courses.learn', ["course" => $course]))
                ->with("message", ["danger", __("Ya has valorado este curso")]);

        }
        $this->validate(request(), [
           "review" => "required|string|min:10",
            "stars" => "required"
        ]);

        $review = Review::create([
           "user_id" => auth()->id(),
           "course_id" => $course->id,
           "stars" => (int) request("stars"),
            "review" => request("review"),
            "created_at" => now()
        ]);

        return redirect(route('courses.learn', ["course" => $course]))
            ->with("message", ["success", __("Muchas gracias por valorar el curso")]);
    }

    public function byCategory(Category $category) {
        $courses = Course::filtered($category);
        return view('learning.courses.by_category', compact('courses', 'category'));
    }
}
