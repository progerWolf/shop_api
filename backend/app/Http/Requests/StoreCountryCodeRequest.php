<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreCountryCodeRequest extends FormRequest
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
            'name' => [
                "required",
                'min:4',
                Rule::unique('country_codes', 'name')->ignore($this->countryCode)
            ] ,
            'iso' => [
                'required',
                'min:2',
                'max:2',
                Rule::unique('country_codes', 'iso')->ignore($this->countryCode)
            ],
            'phone_code' => [
                'required',
                'numeric',
                Rule::unique('country_codes', 'phone_code')->ignore($this->countryCode)
            ],
            'mask' => [
                'required',
                Rule::unique('country_codes', 'mask')->ignore($this->countryCode)
            ],
            'flag' => 'required',
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
            'name.required'                => 'Имя страны является обязательным',
            'name.min'                     => 'Длина имени страны не можеть быть короче 4 символов',
            'name.unique'                  => 'Страна с таким именем уже добавлен',
            'iso.required'                 => 'ISO страны является обязательным',
            'iso.min'                      => 'Длина ISO страны не можеть быть короче 2 символов',
            'iso.unique'                   => 'Страна с таким ISO уже добавлен',
            'iso.max'                      => 'Длина ISO страны не можеть быть больше 2 символов',
            'phone_code.numeric'           => 'Код телефона должен быть числом',
            'phone_code.required'          => 'Код телефона страны является обязательным',
            'phone_code.unique'            => 'Код телефона страны уже добавлен',
            'mask.required'                => 'Маска телефона страны является обязательным',
            'mask.unique'                  => 'Маска телефона страны уже добавлен',
            'flag.required'                => 'Флаг страны является обязательным'
        ];
    }

    /**
     * [failedValidation [Overriding the event validator for custom error response]]
     * @param Validator $validator [description]
     *
     * @return [object][object of various validation errors]
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
