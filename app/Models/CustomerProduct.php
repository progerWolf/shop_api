<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property int $product_id
 */

class CustomerProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'product_id',
    ];

}
