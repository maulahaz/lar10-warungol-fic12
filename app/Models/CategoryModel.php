<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_categories';

    protected $fillable = [
        'name',
        'category',
        'description',
        'picture',
    ];
}
