<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    use SoftDeletes;

    protected $fillable = [
        'product_name', 'product_amount', 'user_id'
    ];

    protected $dates = ['deleted_at'];

    use HasFactory;
}
