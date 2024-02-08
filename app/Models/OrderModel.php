<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_orders';

    protected $fillable = [
        'user_id',
        'address_id',
        'subtotal',
        'shipping_cost',
        'total_cost',
        'status',
        'payment_method',
        'payment_va_name',
        'payment_va_number',
        'payment_ewallet',
        'shipping_service',
        'shipping_resi',
        'transaction_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItemModel::class, 'order_id');
    }
}
