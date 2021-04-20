<?php

namespace App\Mail;

use App\Models\WishList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentWishCourse extends Mailable
{
    use Queueable, SerializesModels;

    public WishList $wishList;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(WishList $wishList)
    {
        $this->wishList = $wishList;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("Nuevo curso en lista de deseos - " . config("app.name"))
            ->markdown('emails.teachers.student_wish_course');
    }
}
