<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $price
 * @property float $sale_price
 * @property int $quantity
 * @property string $img
 * @property int $size_id
 * @property int $color_id
 * @property int $product_id
 *
 * @method static ProductAttribute create(array $attributes = [])
 */

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'sale_price',
        'quantity',
        'img',
        'size_id',
        'color_id',
        'product_id'
    ];

    protected $casts = [
        'price' => 'float',
        'sale_price' => 'float'
    ];

}
