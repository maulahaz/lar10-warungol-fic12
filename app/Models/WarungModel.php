<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarungModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_warungs';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'motto',
        'owner',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'owner');
    }

    public function product()
    {
        return $this->hasMany(ProductModel::class);
    }
}
