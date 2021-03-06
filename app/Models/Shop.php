<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Shop extends Model
{
    use HasFactory;
    use HasSlug;

    public const STATUS_NEW                 = 0;
    public const STATUS_IN_MODERATION       = 1;
    public const STATUS_PUBLISHE            = 2;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'description',
        'phone',
        'image',
        'user_id',
        'category_id',
        'opening_hour',
        'closing_hour',
        'delivery_price',
        'purchase',
        'status'
    ];

    protected $casts = [
        'delivery_price' => 'float',
        'purchase' => 'float',
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

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
