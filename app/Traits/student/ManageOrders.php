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

    public function downloadInvoice(Order $order){
        try {
            if ($order->user_id !== auth()->id()) {
                session()->flash("message", ["danger", __("No tienes acceso a este recurso.")]);
                return back();
            }
            return auth()->user()->downloadInvoice($order->invoice_id, [
               'vendor' => env('APP_NAME'),
               'product' => __("Compra de cursos"),
            ]);

        }catch (\Exception $exception) {
            session()->flash("message", ["danger", __("Ha ocurrido un error descargando la factura.")]);
            return back();
        }
    }
}
