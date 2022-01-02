<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $short_desc
 * @property string $desc
 * @property int $price
 * @property bool $is_active
 */

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_desc',
        'desc',
        'price',
        'is_active'
    ];

}
