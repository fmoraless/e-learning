<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case "POST":
            {
                return [
                    'courses'      => ['required', 'array'],
                    'code'         => [
                        'required',
                        'min:6',
                        'max:20',
                        Rule::unique('coupons')->where(function ($query) {
                            return $query->where('user_id', auth()->id());
                        })
                    ],
                    'description'     => 'required|min:10',
                    'discount_type'   => [
                        'required',
                        Rule::in(Coupon::PERCENT, Coupon::PRICE)
                    ],
                    'discount'        => 'required',
                ];
            }
            case "PUT":
            {
                return [
                    'courses'      => ['required', 'array'],
                    'code'         => [
                        'required',
                        'min:6',
                        'max:20',
                        Rule::unique('coupons')->where(function ($query) {
                            return $query
                                ->where('user_id', auth()->id())
                                ->where('id', '!=', $this->route('coupon')->id);
                        })
                    ],
                    'description'     => 'required|min:10',
                    'discount_type'   => [
                        'required',
                        Rule::in(Coupon::PERCENT, Coupon::PRICE)
                    ],
                    'discount'        => 'required',
                ];
            }
            default:
            {
                return [];
            }
        }
    }
}
