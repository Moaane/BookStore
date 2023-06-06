<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'order_id',
        'book_id',
        'customer_id',
        'order_date',
        'quantity',
        'amount',
        'total',
        'payment_status',
        'order_count',
    ];
}
