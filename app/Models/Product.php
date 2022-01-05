<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $short_desc
 * @property float $price
 * @property float $sale_price
 * @property int $category_id
 * @property int $weight_id
 * @property int $shop_id
 *
 * @method static Product create(array $attributes = [])
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_desc',
        'price',
        'sale_price',
        'category_id',
        'weight_id',
        'shop_id'
    ];

    protected $casts = [
        'price' => 'float',
        'sale_price' => 'float'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * @return BelongsTo
     */
    public function weight(): BelongsTo
    {
        return $this->belongsTo(Weight::class);
    }

}
