<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'short_desc',
        'images',
        'price',
        'user_id',
        'product_category_id',
        'shop_id',
        'status',
    ];

    protected $casts = [
        'price' => 'float',
        'images' => 'array',
        'status' => "integer"
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public const STATUS_NEW                 = 0;
    public const STATUS_IN_MODERATION       = 1;
    public const STATUS_PUBLISHED           = 2;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function product_category() {
        return $this->belongsTo(ProductCategory::class);
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }
}
