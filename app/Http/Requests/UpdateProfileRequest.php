<?php

namespace App\Http\Requests;

use App\Models\CountryCode;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required',
            'avatar' => 'sometimes',
            'change_password' => 'required|boolean',
            'current_password' => 'exclude_if:change_password,false|required|string|min:8',
            'password' => 'exclude_if:change_password,false|required|string|confirmed|min:8'
//            'country_code' => 'required|numeric',
//            'phone' => [
//                'required',
//                'unique:users',
//                Rule::phone()->country(CountryCode::getCountriesIso()),
//            ],
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
            'name.required'           => 'ФИО является обязательным',
            'phone.required'          => 'Номер телефона является обязательным',
//            'phone.phone'             => 'Номер телефона не валиден',
//            'phone.unique'            => 'Пользователь с таким телефоном уже зарегистрирован',
            'password.required'       => 'Пароль является обязательным',
            'password.min'            => 'Пароль должен содержать минимум 8 символов',
            'password.confirmed'      => 'Пароли не совпадают',
            'country_code.required'   => 'Код страны яквляется обязательным',
            'country_code.numeric'    => 'Код страны должен быт числом'
        ];
    }

    /**
     * [failedValidation [Overriding the event validator for custom error response]]
     * @param Validator $validator [description]
     *
     * @return void [object][object of various validation errors]
     */
    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
