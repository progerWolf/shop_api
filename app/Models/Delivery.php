<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 */

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function options(): HasMany
    {
        return $this->hasMany(DeliveryOption::class);
    }
}
