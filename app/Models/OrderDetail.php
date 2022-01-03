<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $worth
 * @property int|null $quantity
 * @property string $weight
 * @property int $start_address_id
 * @property string $first_phone
 * @property int $country_code_id
 * @property string $status
 * @property int $customer_product_id
 * @property int $order_id
 */

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'worth',
        'start_address_id',
        'quantity',
        'weight',
        'first_phone',
        'country_code_id',
        'customer_product_id',
        'status',
        'order_id'
    ];

    protected $with = [
        'product',
        'from'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(CustomerProduct::class, 'customer_product_id');
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(OrderStartAddress::class, 'start_address_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
