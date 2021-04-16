<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentNewOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public User $student;

    /**
     * @var Order
     */
    public Order $order;



    /**
     * Create a new message instance.
     *
     * @param User $student
     * @param Order $order
     */
    public function __construct(User $student, Order $order)
    {
        $this->student = $student;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("Gracias por tu pedido - " . config("app.name"))
            ->markdown("emails.students.new_order");
    }
}
