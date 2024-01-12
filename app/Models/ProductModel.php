<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_products';

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'picture',
        'price',
        'stock',
        'is_available',
    ];
}
