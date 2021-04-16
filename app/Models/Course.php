<?php

namespace App\Models;

use App\Helpers\Currency;
use App\Traits\Hashidable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Course
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $picture
 * @property string $description
 * @property float $price
 * @property int $featured
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\User $teacher
 * @method static Builder|Course filtered(Category $category)
 * @method static Builder|Course forTeacher()
 * @property-read mixed $rating
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit[] $units
 * @property-read int|null $units_count
 * @property-read mixed $formatted_price
 */
class Course extends Model
{
    use Hashidable;

    protected $fillable = [
        "user_id", "title", "description",
        "picture", "price", "featured", "status"
    ];

    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;

    //Rango de precio de los cursos.
    const prices =[
      '9.99' => '9.99',
      '12.99' => '12.99',
      '19.99' => '19.99',
      '29.99' => '29.99',
      '49.99' => '49.99',
    ];

    protected $appends = [
      "rating", "formatted_price"
    ];

    public static function boot() {
        parent::boot();
        //que no se esté ejecutando desde el terminal como ej. un seed
        if (!app()->runningInConsole()) {
            self::saving(function ($table) {
                $table->user_id = auth()->id();
            });
        }
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function students() {
        return $this->belongsToMany(User::class, "course_student");
    }

    public function teacher() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function units() {
        return $this->hasMany(Unit::class)->orderBy("order", "asc");
    }

    public function imagePath() {
        return sprintf('%s/%s', '/storage/courses', $this->picture);
    }

    public function getRatingAttribute() {
        return $this->reviews->avg('stars');
    }

    public function getFormattedPriceAttribute() {
        return Currency::formatCurrency($this->price);
    }

    public function totalVideoUnits() {
        return $this->units->where("unit_type", Unit::VIDEO)->count();
    }

    public function totalFileUnits() {
        return $this->units->where("unit_type", Unit::ZIP)->count();
    }

    public function totalTime() {
        $minutes = $this->units->where("unit_type", Unit::VIDEO)->sum("unit_time");
        return gmdate("H:i",$minutes*60);
    }

    public function scopeFiltered(Builder $builder, Category $category = null){
        $builder->with("teacher");
        $builder->withCount("students");
        $builder->where("status", Course::PUBLISHED);
        if (session()->has('search[courses]')) {
            $builder->where('title', 'LIKE', '%' . session('search[courses]') . '%');
        }

        if ($category){
            $builder->whereHas("categories", function (Builder $table) use ($category) {
               $table->where("id", $category->id);
            });
        }
        return $builder->paginate();
    }

    public function scopeForTeacher(Builder $builder){
        return $builder
            ->withCount('students')
            ->where("user_id",auth()->id())
            ->paginate();
    }
}
