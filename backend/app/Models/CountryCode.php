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
        'mask',
        'flag',
        'is_active'
    ];
}
