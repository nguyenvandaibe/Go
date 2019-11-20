<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPointRequest extends FormRequest
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
            // 'old_order' => 'required|integer|gte:1|exists:points,order',
            // 'new_order' => 'required|integer|gte:1|exists:points,order',
            // 'place' => 'required|string|max:255',
            // 'place_lat' => 'required|numeric|gte:-90|lte:90',
            // 'place_lng' => 'required|numeric|gte:-180|lte:180',
            // 'arrive_time' => 'required|after:now',
            // 'depature_time' => 'nullable|after_or_equal:arrive_time',
            // 'vehicle' => 'required',
            // 'activity' => 'required|string|max:255',
        ];
    }
}
