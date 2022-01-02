<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property bool $is_active
 */

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'is_active'
    ];

    public function options(): HasMany
    {
        return $this->hasMany(DeliveryOption::class);
    }
}
