<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShopRequest extends FormRequest
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
            'address' =>  'required',
            'description' =>  'required',
            'phone' =>'required',
            'image' =>'required',
            'category_id' =>  'required',
            'opening_hour' => 'required|date_format:H:i',
            'closing_hour' => 'required|date_format:H:i',
            'purchase' => 'required',
            'dashboard' => 'boolean',
            'delivery_price' => 'exclude_if:dashboard,false|required',
            'user_id' => 'exclude_if:dashboard,false|required',
            'status' => 'exclude_if:dashboard,false|required',
            
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
            'address.required'              => 'Адрес является обязательным',
            'description.required'          => 'Описание является обязательным',
            'phone.required'                => 'Номер телефона является обязательным',
            'image.required'                => 'Изоброжение является обязательным',
            'category_id.required'          => 'Категория является обязательным',
            'opening_hour.required'         => 'Время работы от является обязательным',
            'closing_hour.required'         => 'Время работы до является обязательным',
            'purchase.required'             => 'Покупка от является обязательным',
            'opening_hour.date_format'      => 'Время работы не соответствует формату',
            'closing_hour.date_format'      => 'Время работы не соответствует формату',
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
