<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $categories = Category::withCount("courses")->get();
        $featuredCourses = Course::withCount("students")
            ->with("categories", "teacher")
            ->whereFeatured(true)
            ->whereStatus(Course::PUBLISHED)
            ->get();
        $total = $featuredCourses->count();
        //dd($total);

        return view('welcome', compact('categories', 'featuredCourses'));

    }
}
