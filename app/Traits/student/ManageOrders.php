<?php
namespace App\Traits\Student;

use App\Models\Order;

trait ManageOrders {

    public function orders() {
        $orders = auth()->user()->processedOrders();
        return view('student.orders.index', compact('orders'));
    }
}
