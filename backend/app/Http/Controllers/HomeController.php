<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountryCode;

class HomeController extends Controller
{
    public function getCountryCodes()
    {
        return response()->json([
            'country_codes' => CountryCode::where('is_active', 1)->get()
        ]);
    }
}
