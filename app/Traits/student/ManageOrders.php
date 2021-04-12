<?php
namespace App\Traits\Student;

use App\Models\Order;

trait ManageOrders {

    public function orders() {
        $orders = auth()->user()->processedOrders();
        return view('student.orders.index', compact('orders'));
    }

    public function showOrder(Order $order) {
        $order->load("order_lines.course", "coupon")
            ->loadCount("order_lines");
        //dd($order);
        return view('student.orders.show', compact('order'));
    }
}
