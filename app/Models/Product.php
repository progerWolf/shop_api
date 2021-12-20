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

    public const STATUS_NEW                 = 0;
    public const STATUS_IN_MODERATION       = 1;
    public const STATUS_PUBLISHED           = 2;

    protected $fillable = [
        'name',
        'slug',
        'short_desc',
        'images',
        'price',
        'user_id',
        'category_id',
        'shop_id',
        'status',
        'quantity'
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

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }
}
