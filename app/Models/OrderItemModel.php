<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_items';

    protected $fillable=[
        'order_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }
}
