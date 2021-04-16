<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::post(
    'stripe/webhook',
    'StripeWebHookController@handleWebHook'
);

/**
 * COURSE ROUTES
 */
Route::group(['prefix' => 'courses', 'as' => 'courses.' ], function() {
    Route::get('/', 'CourseController@index')->name('index');
    Route::post('/search', 'CourseController@search')->name('search');
    Route::get('/{course}', 'CourseController@show')->name('show');
    Route::get('/{course}/learn', 'CourseController@learn')
        ->name('learn')->middleware("can_access_to_course");

    Route::get('/{course}/review', 'CourseController@createReview')
        ->name('reviews.create');
    Route::post('/{course}/review', 'CourseController@storeReview')
        ->name('reviews.store');
    Route::get('/category/{category}', 'CourseController@byCategory')
        ->name('category');

});


Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => ['teacher']], function() {
    Route::get('/', 'TeacherController@index')->name('index');

    /**
     * TEACHER COURSES ROUTES
     */
    Route::get('/courses', 'TeacherController@courses')->name('courses');
    Route::get('/courses/create', 'TeacherController@createCourse')
        ->name('courses.create');
    Route::post('/courses/store', 'TeacherController@storeCourse')
        ->name('courses.store');
    Route::get('/courses/{course}', 'TeacherController@editCourse')
        ->name('courses.edit');
    Route::put('/courses/{course}', 'TeacherController@updateCourse')
        ->name('courses.update');

    /**
     * UNIT ROUTES
     */
    Route::get('/units', 'TeacherController@units')->name('units');
    Route::get('/units/create', 'TeacherController@createUnit')
        ->name('units.create');
    Route::post('/units/store', 'TeacherController@storeUnit')
        ->name('units.store');
    Route::get('/units/{unit}', 'TeacherController@editUnit')
        ->name('units.edit');
    Route::put('/units/{unit}', 'TeacherController@updateUnit')
        ->name('units.update');
    Route::delete('/units/{unit}', 'TeacherController@destroyUnit')
        ->name('units.destroy');

    /**
     * COUPON ROUTES
     */
    Route::get('/coupons', 'TeacherController@coupons')
        ->name('coupons');
    Route::get('/coupons/create', 'TeacherController@createCoupon')
        ->name('coupons.create');
    Route::post('/coupons/store', 'TeacherController@storeCoupon')
        ->name('coupons.store');
    Route::get('/coupons/{coupon}', 'TeacherController@editCoupon')
        ->name('coupons.edit');
    Route::put('/coupons/{coupon}', 'TeacherController@updateCoupon')
        ->name('coupons.update');
    Route::delete('/coupons/{coupon}', 'TeacherController@destroyCoupon')
        ->name('coupons.destroy');
});

/**
 * STUDENT ROUTES
 */
Route::group(['prefix' => 'student', 'as' => 'student.', 'middleware' => ['auth']], function() {
    Route::get('/', 'StudentController@index')->name('index');

    Route::get("/credit-card", "BillingController@creditCardForm")
    ->name("billing.credit_card_form");
    Route::post('/credit-card', "BillingController@processCreditCardForm")
    ->name("billing.process_credit_card");

    Route::get("/courses", "StudentController@courses")
        ->name('courses');

    /**
     * ORDER ROUTES
     */
    Route::get("/orders", "StudentController@orders")
        ->name('orders');
    Route::get("/orders/{order}", "StudentController@showOrder")
        ->name('orders.show');
    Route::get("/orders/{order}/download_invoice", "StudentController@downloadInvoice")
        ->name('orders.download_invoice');
});


/**
 * CART ROUTES
 */
Route::get('/add-course-to-cart/{course}', 'StudentController@addCourseToCart')
    ->name('add_course_to_cart');
Route::get('/cart', 'StudentController@showCart')
    ->name('cart');
Route::get('/remove-course-from-cart/{course}', 'StudentController@removeCourseFromCart')
    ->name('remove_course_from_cart');

/**
 * COUPON ROUTES
 */
Route::post('/apply-coupon', 'StudentController@applyCoupon')
    ->name('apply_coupon');


Route::group(["middleware" => ["auth"]], function () {
   Route::get('/checkout', 'CheckoutController@index')
       ->name('checkout-form') ;
    Route::post('/checkout', 'CheckoutController@processOrder')
        ->name('process_checkout') ;
});
/*Route::get('/phpinfo', function () {
    phpinfo();
});*/
