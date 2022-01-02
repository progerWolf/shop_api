<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $phone
 * @property int $country_code_id
 * @property int $address_id
 * @property int|null $user_id
 */


class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'country_code_id',
        'user_id'
    ];

    protected $with = [
       'user'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
