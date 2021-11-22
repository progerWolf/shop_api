<?php

namespace App\Http\Requests;

use App\Models\CountryCode;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ConfirmNumberRequest extends FormRequest
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
            'phone' => [
                'required',
                Rule::phone()->country(CountryCode::getCountriesIso()),
            ],
            'confirm_code'  => 'required|numeric',
            'country_code' => 'required|numeric'
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
            'phone.required'            => 'Номер телефона является обязательным',
            'phone.phone'               => 'Номер телефона не валиден',
            'confirm_code.required'     => 'Код для подтверждение яквляется обязательным',
            'confirm_code.numeric'      => 'Код для подтверждение должен быт числом',
            'country_code.required'     => 'Код страны яквляется обязательным',
            'country_code.numeric'      => 'Код страны должен быт числом'
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
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
