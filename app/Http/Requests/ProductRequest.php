<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' =>  'nullable',
            'short_desc' =>  'required',
            'images' =>'required|array',
            'attributeValues' => 'required|array'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'                 => 'Название является обязательным',
            'price.required'                => 'Цена является обязательным',
            'quantity.required'             => 'Количество является обязательным',
            'description.required'          => 'Описание является обязательным',
            'images.required'               => 'Изоброжение является обязательным',
            'attributeValues.required'      => 'Атрибуты является обязательным',
        ];
    }

    /**
     * [failedValidation [Overriding the event validator for custom error response]]
     * @param Validator $validator [description]
     *
     * @return void [object][object of various validation errors]
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
