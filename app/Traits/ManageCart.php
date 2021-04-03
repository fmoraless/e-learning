<?php
namespace App\Traits;


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
}
