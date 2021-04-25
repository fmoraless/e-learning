<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteResource
{
    /**
     * @var mixed|string
     */
    protected string $controller;

    /**
     * @var mixed|string
     */
    protected string $path;

    /**
     * @var mixed|string
     */
    protected string $model;

    /**
     * @var array
     */
    protected array $routeData;

    /**
     * CustomRouteResources constructor
     * @param array $routeData
     */
    public function __construct(array $routeData) {
        $this->controller = $routeData["controller"];
        $this->path = $routeData["path"];
        $this->model = Str::singular($routeData["path"]);
        $this->routeData = $routeData;
    }

    /**
     * Route generator calling methods dynamically with call_user_func
     */
    public function generator() {
        foreach ($this->routeData["routes"] as $route) {
            //resourceIndex
            //resourceStore
            call_user_func([$this,sprintf("resource%s",ucfirst($route))]);
        }
    }

    /**
     * Build index routes
     *
     * Route::get('/courses', 'TeacherController@courses')->name('courses');
     *
     */
    protected function resourceIndex()
    {
        Route::get(
            $this->path,
            sprintf("%s@%s",$this->controller, $this->path)
        )
        ->name($this->path);
    }

    /**
     * Build create routes
     *
     * Route::get('/courses/create', 'TeacherController@createCourse')
     *  ->name('courses.create');
     *
     */
    protected function resourceCreate()
    {
        Route::get(
            sprintf("%s/create", $this->path),
            sprintf(
                "%s@%s",
                $this->controller,
                sprintf("create%s", ucfirst($this->model))
            )
        )
            ->name(sprintf("%s.%s", $this->path, "create"));
    }


    /**
     * Build store routes
     *
     * Route::post('/courses/store', 'TeacherController@storeCourse')
    ->name('courses.store');
     *
     */
    protected function resourceStore()
    {
        Route::post(
            $this->path,
            sprintf(
                "%s@%s",
                $this->controller,
                sprintf("store%s", ucfirst($this->model))
            )
        )
            ->name(sprintf("%s.%s", $this->path, "store"));
    }


    /**
     * Build show routes
     *
     * Route::get('/courses/{course}', 'TeacherController@showourse')
    ->name('courses.show');
     *
     */
    protected function resourceShow()
    {
        Route::get(
            sprintf("%s/{%s}", $this->path, $this->model),
            sprintf(
                "%s@%s",
                $this->controller,
                sprintf("show%s", ucfirst($this->model))
            )
        )
            ->name(sprintf("%s.%s", $this->path, "show"));
    }


    /**
     * Build edit routes
     *
     * Route::get('/courses/{course}', 'TeacherController@editCourse')
    ->name('courses.edit');
     *
     */
    protected function resourceEdit()
    {
        Route::get(
            sprintf("/%s/{%s}/edit", $this->path, $this->model),
            sprintf(
                "%s@%s",
                $this->controller,
                sprintf("edit%s", ucfirst($this->model))
            )
        )
            ->name(sprintf("%s.%s", $this->path, "edit"));
    }


    /**
     * Build update routes
     *
     * Route::put('/courses/{course}', 'TeacherController@updateCourse')
    ->name('courses.update');
     *
     */
    protected function resourceUpdate()
    {
        Route::put(
            sprintf("/%s/{%s}", $this->path, $this->model),
            sprintf(
                "%s@%s",
                $this->controller,
                sprintf("update%s", ucfirst($this->model))
            )
        )
            ->name(sprintf("%s.%s", $this->path, "update"));
    }


    /**
     * Build destroy routes
     *
     * Route::delete('/courses/{course}', 'TeacherController@destroyCourse')
        ->name('course.destroy');
     *
     */
    protected function resourceDestroy()
    {
        Route::delete(
            sprintf("%s/{%s}", $this->path, $this->model),
            sprintf(
                "%s@%s",
                $this->controller,
                sprintf("destroy%s", ucfirst($this->model))
            )
        )
            ->name(sprintf("%s.%s", $this->path, "destroy"));
    }

}
