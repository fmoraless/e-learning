<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Response;
use Laravel\Cashier\Http\Controllers\WebhookController;

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
        return new Response('Webhook Handled: {handleChargeSucceeded}', 200);
    }
}
