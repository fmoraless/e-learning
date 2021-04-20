<?php
namespace App\Traits\Student;

use App\Models\Course;
use App\Models\WishList;

trait ManageWishLists {

    public function toggleItemOnWishlist(Course $course)
    {
        if (request()->ajax()) {
            $courseInMyWishList = WishList::where("course_id", $course->id)
                ->first();
            if (!$courseInMyWishList){
                WishList::create([
                    "course_id" => $course->id
                ]);
            }else{
                $courseInMyWishList->delete();
            }
            return response(["message" => "success"]);

        }
        return abort(401);
    }
}
