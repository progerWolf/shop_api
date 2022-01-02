<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $tariff_id
 * @property int $delivery_option_id
 * @property bool $confirmed
 * @property int $confirm_code
 */


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'delivery_option_id',
        'tariff_id',
        'confirmed',
        'confirm_code'
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function deliveryOption(): HasOne
    {
        return $this->hasOne(DeliveryOption::class, 'delivery_option_id');
    }

    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class, 'tariff_id');
    }

}
