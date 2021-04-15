<?php

namespace App\Models;

use App\Helpers\Currency;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderLine
 *
 * @property int $id
 * @property int $order_id
 * @property int|null $course_id
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Course|null $course
 * @property-read mixed $formatted_price
 */
class OrderLine extends Model
{
    protected $fillable = [
      "course_id", "order_id", "price"
    ];

    protected $appends = [
        "formatted_price"
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function getFormattedPriceAttribute(){
        return Currency::formatCurrency($this->price, false);
    }
}
