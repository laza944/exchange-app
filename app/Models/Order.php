<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'currency_purchased_name',
        'currency_purchased_code',
        'currency_purchased_amount',
        'currency_purchased_rate',
        'surcharge_percentage',
        'surcharge_amount',
        'paid_amount',
        'discount_percentage',
        'discount_amount',
    ];
}
