<?php

namespace App\Listeners;

use App\Events\CourseAddedToWishList;
use App\Mail\StudentWishCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCourseWishedEmailToTeacher
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CourseAddedToWishList  $event
     * @return void
     */
    public function handle(CourseAddedToWishList $event)
    {
        Mail::to($event->wishList->course->teacher->email)
            ->send(new StudentWishCourse($event->wishList));
    }
}
