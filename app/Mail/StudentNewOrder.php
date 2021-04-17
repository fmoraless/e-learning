<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Laravel\Cashier\Invoice;

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
     * @var Invoice|null
     */
    public Invoice $invoice;


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
        $this->invoice = $this->student->findInvoice($this->order->invoice_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $vendor = config("app.name");
        $product = "Compra de cursos";
        $invoice = $this->invoice;
        $owner = $this->student;
        $pdf = \PDF::loadview('vendor.cashier.receipt', compact('invoice','vendor', 'product','owner'));
        return $this
            ->attachData($pdf->output(), $this->invoice->id . '-' .date('d-m-Y') .'.pdf', ['mime' => 'application/pdf'])
            ->subject("Gracias por tu pedido - " . config("app.name"))
            ->markdown("emails.students.new_order");
    }
}
