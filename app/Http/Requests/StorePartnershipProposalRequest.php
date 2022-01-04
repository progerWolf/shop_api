<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePartnershipProposalRequest extends FormRequest
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
            // 'user_id' => 'sometimes|unique:users,id',
            'passport_front_side' => 'required|string',
            'passport_back_side' => 'required|string',
            'selfie_with_passport' => 'required|string',
            'type' => 'in:courier,store'
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
            'flag.required'                => 'Флаг страны является обязательным'
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
