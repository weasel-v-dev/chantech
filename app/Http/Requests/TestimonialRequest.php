<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
        return [
            'data' => 'array|required',
            'data.0' => 'required',
            'data.0.rating' => 'required|numeric|between:0,99.99',
            'data.0.review' => 'required',
            'data.0.email' => 'required|email',
            'data.0.reviewer'  => 'required|string',
            'data.0.employees_position' => 'required|string',
            'data.0.unique_employee_number' => 'required',
            'data.0.employee' => 'required|string',
            'data.0.company' => 'required',
            'data.0.company_description' => 'required'
        ];
    }
}
