<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmPassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'confirm_code',
        'qty',
        'confirmed',
    ];
}
