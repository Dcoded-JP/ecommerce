<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'company_name',
        'country',
        'street_address',
        'apartment',
        'city',
        'state',
        'zip_code',
        'phone',
        'email',
        'order_notes',
        'shipping_method',
        'payment_method',
        'different_shipping',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_company_name',
        'shipping_country',
        'shipping_street_address',
        'shipping_apartment',
        'shipping_city',
        'shipping_state',
        'shipping_zip_code',
        'subtotal',
        'shipping_cost',
        'tax',
        'total',
        'status',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
