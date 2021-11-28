<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso',
        'phone_code',
        'maxlength',
        'minlength',
        'flag',
        'is_active'
    ];

    public function scopeGetCountriesIso($query): array
    {
        $countryCodes = $query->select('iso')->where('is_active', true)->first();

        dump($countryCodes->iso);
        $codes[] = $countryCodes->iso;

        return $codes;
    }
}
