<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $title
 * @property $body
 * @property $is_active
 *
 * @method static Faq create(array $values)
 */

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'is_active'];
}
