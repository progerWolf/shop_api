<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'img' => 'required',
            'size_id' => 'required|numeric',
            'color_id' => 'required|numeric',
            'product_id' => 'required|numeric'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'price.required' => 'Цена является обязательным',
            'sale_price.required' => 'Цена по скидке является обязательным',
            'quantity.required' => 'Количество является обязательным',
            'img.required' => 'Фотография является обязательным',
            'size_id.required' => 'Размер является обязательным',
            'color_id.required' => 'Цвет является обязательным',
            'product_id.required' => 'Продукт является обязательным',
        ];
    }

    /**
     * [failedValidation [Overriding the event validator for custom error response]]
     * @param Validator $validator [description]
     *
     * @return void [object][object of various validation errors]
     */
    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
