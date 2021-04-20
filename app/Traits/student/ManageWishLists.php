<?php
namespace App\Traits\Student;

use App\Events\CourseAddedToWishList;
use App\Models\Course;
use App\Models\WishList;

trait ManageWishLists {

    public function toggleItemOnWishlist(Course $course)
    {
        if (request()->ajax()) {
            $courseInMyWishList = WishList::where("course_id", $course->id)
                ->first();
            if (!$courseInMyWishList){
                $wishList = WishList::create([
                    "course_id" => $course->id
                ]);
                $wishList->load("user", "course.teacher");
                event(new CourseAddedToWishList($wishList));
            }else{
                $courseInMyWishList->delete();
            }
            return response(["message" => "success"]);

        }
        return abort(401);
    }

    public function meWishList()
    {
        $wishlist = WishList::with("course")->paginate();
        return view("student.wishlist.index", compact('wishlist'));

    }

    public function destroyWishListItem(int $id)
    {
        $wishlist = WishList::findOrFail($id);
        $wishlist->delete();
        session()->flash("message", ["success", __("Has eliminado el curso de tu lista de deseos.")]);
        return redirect(route('student.wishlist.me'));
    }
}
