<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $stars
 * @property string $review
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereStars($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Course $course
 */
class Review extends Model
{
    protected $fillable = [
      "user_id", "course_id","stars","review"
    ];

    public function course(){
      return $this->belongsTo(Course::class)  ;
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id')  ;
    }
}
