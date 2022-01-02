<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $price
 * @property string $description
 * @property string $title
 * @property string $img
 * @property int $delivery_id
 */

class DeliveryOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'description',
        'title',
        'img',
        'delivery_id'
    ];

    protected $with = [
        'delivery'
    ];

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

}
