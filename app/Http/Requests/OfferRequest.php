<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name_ar' =>  'required|max:100|unique:offers,name_ar',
            'name_en' =>  'required|max:100|unique:offers,name_en',
            'price' =>  'required|numeric',
            'details_ar' =>  'required',
            'details_en' =>  'required',
        ];
    }

    public function messages()
    {
        return[
            'name_ar.required' => __('messages.offer name'),
            'name_ar.unique' => __('messages.offer nameun'),
            'name_ar.max' => __('messages.offer namemx'),

            'name_en.required' => __('messages.offer name'),
            'name_en.unique' => __('messages.offer nameun'),
            'name_en.max' => __('messages.offer namemx'),
            
            'price.required' =>__('messages.offer price req'),
            'price.numeric' =>__('messages.offer price num'),
            'details_ar.required' => __('messages.offer details'),
            'details_en.required' => __('messages.offer details'),
        ];
    }
}
