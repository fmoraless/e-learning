<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Order;
use App\Models\Unit;
use App\Models\User;
use Hashids\Hashids;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('user', function ($value, $route) {
            return $this->getModel(User::class, $value);
        });

        Route::bind('unit', function ($value, $route) {
            return $this->getModel(Unit::class, $value);
        });

        Route::bind('course', function ($value, $route) {
            return $this->getModel(Course::class, $value);
        });

        Route::bind('coupon', function ($value, $route) {
            return $this->getModel(Coupon::class, $value);
        });

        Route::bind('order', function ($value, $route) {
            return $this->getModel(Order::class, $value);
        });

        Route::bind('category', function ($value, $route) {
            return $this->getModel(Category::class, $value);
        });
    }

    protected function getModel($model, $routeKey) {
        $id = \Hashids::connection($model)->decode($routeKey)[0];
        $modelInstance = resolve($model);
        return $modelInstance->findOrFail($id);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
