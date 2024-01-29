<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_addresses';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'province_id',
        'city_id',
        'district_id',
        'postal_code',
        'user_id',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }
}
