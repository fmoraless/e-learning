<?php
namespace App\Traits\Teacher;

use App\Models\Coupon;

trait ManageCoupons {

    public function coupons() {
        $coupons = Coupon::forTeacher();
        return view('teacher.coupons.index', compact('coupons'));
    }

    public function createCoupon() {
        $coupon = new Coupon;
        $title = __("Crear un nuevo cupón");
        $textButton = __("Dar de alta el cupón");
        $options = ['route' => ['teacher.coupons.store']];
        return view('teacher.coupons.create', compact('title','coupon', 'textButton', 'options'));
    }
}
