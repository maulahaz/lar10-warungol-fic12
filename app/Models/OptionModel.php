<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_options';

    protected $fillable = [
        'for',
        'key',
        'value',
        'code',
        'description',
    ];
}
