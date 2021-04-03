<?php
namespace App\Traits\Teacher;

use App\Helpers\Uploader;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\Course;
use DB;

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

    public function storeCoupon(CouponRequest $request) {
        try {
            DB::beginTransaction();

            $input = $this->couponInput();
            $coupon = Coupon::create($input);
            $coupon->courses()->sync(request("courses"), false);

            DB::commit();
            session()->flash("message", ["success", __("Cupon creado correctamente")]);
            return redirect(route('teacher.coupons.edit', ['coupon' => $coupon]));

        }catch(\Throwable $exception) {
            \DB::rollBack();
            session()->flash("message", ["danger", $exception->getMessage()]);
            return back();
        }
    }

    public function couponInput(): array {
        return request()->only(
            "code",
            "description",
            "discount_type",
            "discount",
            "enabled",
            "expires_at",
        );
    }
}
