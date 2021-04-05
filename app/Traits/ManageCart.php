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
        session()->remove("coupon");
        session()->save();
        $code = request("coupon");
        $coupon = Coupon::abailable($code)->first();
        if (!$coupon) {
            session()->flash("message",
                ["danger", __("El código de cupón introducido no es válido para este curso.")]);
            return back();
        }

        $cart = new Cart;
        $coursesInCart = $cart->getContent()->pluck("id");
        //Validar si los cursos que estan en el carro aplican para este cupon
        $totalCourses = $coupon->courses()->whereIn("id", $coursesInCart)->count();
        //dd($totalCourses);

        if ($totalCourses) {
            session()->put("coupon", $code);
            session()->save();
            session()->flash("message", ["success", __("El cupón se ha aplicado correctamente.")]);
            return back();
        }
        session()->flash("message", ["danger", __("El cupón no se ha aplicado.")]);
        return back();
    }
}
