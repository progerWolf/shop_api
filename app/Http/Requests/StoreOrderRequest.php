<?php

namespace App\Http\Requests;

use App\Models\CountryCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
            'tariff_id' => 'required',
            'country_code_id' => 'required',
            'delivery_option_id' => 'required',
            'product_title' => 'required',
            'start_address_title' => 'required',
            'start_address_latitude' => 'required',
            'start_address_longitude' => 'required',
            'first_phone_country_code_id' => 'required',
            'worth' => 'required',
            'weight' => 'required',
            'quantity' => 'sometimes',
            'customer_address' => 'required',
            'customer_latitude' => 'required',
            'customer_longitude' => 'required',
            'first_phone' => [
                'required',
                Rule::phone()->country(CountryCode::getCountriesIso()),
            ],
            'phone' => [
                'required',
                Rule::phone()->country(CountryCode::getCountriesIso()),
            ],
        ];
    }
}
