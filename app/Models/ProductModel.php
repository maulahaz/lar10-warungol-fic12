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
        'readiness',
        'is_available',
        'seller_id',
        'warung_id',
    ];

    public function category() {
        return $this->belongsTo(CategoryModel::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // public function warung() {
    //     return $this->belongsTo(WarungModel::class, 'warung_id');
    // }
}
