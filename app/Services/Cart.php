<?php

namespace App\Services;
use App\Helpers\Currency;
use App\Models\Course;
use Illuminate\Support\Collection;

/**
 * Class Cart
 * @package App\Classes
 */

class Cart
{
    /**
     *
     * @var Collection
     */
    protected Collection $cart;


    /**
     *
     * Cart constructor
     */
    public function __construct() {
        if (session()->has("cart")) {
            $this->cart = session("cart");
        }else{
            $this->cart = new Collection;
        }
    }

    /**
     *
     * Get cart content
     */
    public function getContent(): Collection {
        return $this->cart;
    }

    /**
     *
     * Save the cart on session
     */
    protected function save(): void {
        session()->put("cart", $this->cart);
        session()->save();
    }

    /**
     *
     * Add Course to cart
     *
     * @param Course $course
     */
    public function addCourse(Course $course): void {
        $this->cart->push($course);
        $this->save();
    }


    /**
     *
     * Remove Course from cart
     *
     * @param int $id
     */
    public function removeCourse(int $id): void {
        $this->cart = $this->cart->reject(function (Course $course) use ($id) {
            return $course->id === $id;
        });
        $this->save();
    }

    /**
     *
     * Calculates the total cost in the cart
     *
     * @param bool $formatted
     * @return mixed
     */
    public function totalAmount($formatted = true) {
        $amount = $this->cart->sum(function (Course $course) {
           return $course->price;
        });
        if ($formatted) {
            return Currency::formatCurrency($amount);
        }
        return $amount;
    }

    /**
     *
     * Calculates taxes cost in the cart
     *
     * @param bool $formatted
     * @return float|int|string
     */
    public function taxes($formatted = true) {
        $total = $this->totalAmount(false);
        if ($total){
            $total = ($total *env('TAXES')) / 100;
            if ($formatted) {
                return Currency::formatCurrency($total);
            }
            return $total;
        }
        return 0;
    }

    /**
     *
     * Total products in the cart
     *
     */
    public function hasProducts(): int {
        return $this->cart->count();
    }

    /**
     *
     * clear cart
     *
     */
    public function clearCart(): void {
        $this->cart = new Collection;
        $this->save();
    }

}
