<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $title
 * @property $description
 * @property $short_description
 * @property $image
 * @property $is_active
 * @property $type
 *
 * @method static Post create(array $values)
 */

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'image',
        'is_active',
        'type'
    ];
}
