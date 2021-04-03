<?php
namespace App\Traits;


use App\Models\Coupon;
use App\Models\Course;
use App\Services\Cart;

trait ManageCart {
    public function showCart() {
        return view('learning.cart');
    }

    public function addCourseToCart(Course $course) {
        $cart = new Cart;
        $cart->addCourse($course);
        session()->flash("message", ["success", __("Curso añadido al carrito correctamente.")]);
        return redirect(route('cart'));
    }

    public function removeCourseFromCart(Course $course) {
        $cart = new Cart;
        $cart->removeCourse($course->id);
        session()->flash("message", ["success", __("Curso eliminado del carrito correctamente.")]);
        return back();
    }

    public function applyCoupon() {
        $code = request("coupon");
        $coupon = Coupon::whereCode($code)->first();
        if (!$coupon) {
            session()->flash("message",
                ["danger", __("El código de cupón introducido no es válido para este curso.")]);
        }else {
            session()->flash("message",
                ["success", __("El código de cupón :code se ha aplicado correctamente.", ["code" => $code])]);
        }
        return back();
    }
}
