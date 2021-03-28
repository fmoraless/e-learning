<?php

namespace App\Http\Requests;

use App\Models\Unit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitRequest extends FormRequest
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
            case 'POST':
            {
                return [
                    'title' => 'required|min:6|max:200',
                    'content' => 'required_if:unit_type,'.Unit::VIDEO,
                    'course_id' => [
                        'required',
                        Rule::exists('courses', 'id')
                    ],
                    'unit_type' => [
                        'required',
                        Rule::in(Unit::unitTypes())
                    ],
                    'file' => 'required_if:unit_type,'.Unit::ZIP .'|file',
                    'unit_time' => 'required_if:unit_type,'.Unit::VIDEO,
                ];
            }
            case 'PUT':
            {
                return [
                    'title' => 'required|min:6|max:200',
                    'content' => 'required_if:unit_type,'.Unit::VIDEO,
                    'course_id' => [
                        'required',
                        Rule::exists('courses', 'id')
                    ],
                    'unit_type' => [
                        'required',
                        Rule::in(Unit::unitTypes())
                    ],
                    'file' => 'required_if:unit_type,'.Unit::ZIP.'|sometimes|file',
                    'unit_time' => 'required_if:unit_type,'.Unit::VIDEO,
                ];
            }
            default:
            {
                return [];
            }
        }
    }
}
