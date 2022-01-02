<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $latitude
 * @property string $longitude
 */

class OrderStartAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'latitude',
        'longitude',
    ];
}
