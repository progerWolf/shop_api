<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $latitude
 * @property string $longitude
 * @property int $order_id
 */

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        'order_id'
    ];
}
