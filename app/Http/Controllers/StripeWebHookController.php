<?php

namespace App\Http\Controllers;

use App\Mail\StudentNewOrder;

use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Http\Controllers\WebhookController;
use App\Jobs\SendTeacherSalesEmail;
use PharIo\Version\Exception;
use Log;

class StripeWebHookController extends WebhookController
{
    /**
     *
     * WEBHOOK que se encarga de obtener un evento al hacer un pago correctamente.
     * charge.succeeded
     * @param $payload
     * @return Response
     */

    public function handleChargeSucceeded($payload) {
        try {
            $invoice_id = $payload['data']['object']["invoice"];
            $user = $this->getUserByStripeId($payload['data']['object']['customer']);
            if ($user) {
                $order = $user->orders()
                        ->where("status", Order::PENDING)
                        ->latest()
                        ->first();
                if ($order) {
                    $order->load("order_lines.course.teacher");
                    $order->update([
                       'invoice_id' => $invoice_id,
                       'status'     => Order::SUCCESS
                    ]);

                    //ATTACH COURSES FOR USER
                    $coursesId = $order->order_lines()->pluck("course_id");
                    Log::info(json_encode($coursesId));
                    $user->courses_learning()->attach($coursesId);


                    Log::info(json_encode($user));
                    Log::info(json_encode($order));
                    Log::info("Pedido actualizado correctamente");

                    Mail::to($user->email)->send(new StudentNewOrder($user, $order));

                    foreach($order->order_lines as $order_line) {
                        SendTeacherSalesEmail::dispatch(
                            $order_line->course->teacher,
                            $user,
                            $order_line->course
                        )->onQueue("emails");
                    }

                    return new Response('Webhook Handled: {handleChargeSucceeded}',200);
                }
            }
        } catch (\Exception $exception){
            Log::debug("Excepción Webhook {handleChargeSucceeded}: " . $exception->getMessage() . ", Line: " . $exception->getLine() . ', File: ' . $exception->getFile());
            return new Response('Webhook Handled: {handleChargeSucceeded}', 400);
        }

    }
}
