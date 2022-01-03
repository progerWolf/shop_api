<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreFaqRequest extends FormRequest
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
            'title' => 'required|string|min:10',
            'body' => 'required|string|min:100',
            'is_active' => 'boolean',
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
            'title.required'                => 'Имя является обязательным',
            'body.required'                 => 'Описание является обязательным',
            'title.string'                  => 'Имя должна быть строкой',
            'body.string'                   => 'Описание должна быть строкой',
            'title.min'                     => 'Имядолжен содержать минимум 10 символов',
            'body.min'                      => 'Описаниедолжен содержать минимум 100 символов',
        ];
    }

    /**
     * [failedValidation [Overriding the event validator for custom error response]]
     * @param Validator $validator [description]
     *
     * @return void [object][object of various validation errors]
     */
    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
