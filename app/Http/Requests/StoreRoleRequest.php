<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRoleRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'display_name' => 'required|max:255',
            'name' => 'required|max:100|alpha_dash|unique:roles,name',
            'permissions' => 'nullable'
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
            'display_name.required'   => 'Пользовательская имя является обязательным',
            'display_name.max'        => 'Слишком длинная пользовательская имя',
            'name.required'           => 'Имя является обязательным',
            'name.max'                => 'Слишком длинная имя',
            'name.unique'             => 'Имя уже занято',
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
