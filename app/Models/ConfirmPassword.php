<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConfirmPassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'confirm_code',
        'qty',
        'confirmed',
        'country_code_id'
    ];

    public function countryCode(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class);
    }
}
