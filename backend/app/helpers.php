<?php

use App\Models\CountryCode;
use Illuminate\Http\JsonResponse;
use Propaganistas\LaravelPhone\PhoneNumber;

if (!function_exists('checkAndFormatNumberCountry')){
    function checkAndFormatNumberCountry (&$request): JsonResponse|bool
    {
        $object = new PhoneNumber($request->phone);
        $iso = CountryCode::select('iso')
            ->where('is_active', true)
            ->where('id', $request->country_code)
            ->first();

        try {
            $object = $object->ofCountry($iso->iso);
            $check = $object->isOfCountry($iso->iso);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Введённый номер не совпадает с выбранной страной'
            ], 400);
        }

        if (!$check) {
            return response()->json([
                'phone' => [
                    'Введённый номер не валиден'
                ]
            ], 422);
        }

        $request->phone = PhoneNumber::make($request->phone, $iso->iso)->formatE164();

        return $check;
    }
}
