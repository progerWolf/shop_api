<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
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
            'description' => 'required|string|min:100',
            'image' => 'required|string',
            'is_active' => 'boolean',
            'type' => 'string'
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
            'title.required'                => 'Имя поста является обязательным',
            'description.required'          => 'Описание поста является обязательным',
            'image.required'                => 'Изображение поста является обязательным',
            'type.required'                 => 'Тип поста является обязательным',
            'title.string'                  => 'Имя поста должна быть строкой',
            'description.string'            => 'Описание поста должна быть строкой',
            'title.min'                     => 'Имя поста должен содержать минимум 10 символов',
            'description.min'               => 'Описание поста должен содержать минимум 100 символов',
            'type.in'                       => 'Указанный вами тип не найден'
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
