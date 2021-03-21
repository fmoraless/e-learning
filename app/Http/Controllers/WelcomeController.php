<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $categories = Category::withCount("courses")->get();
        return view('welcome', compact('categories'));

    }
}
