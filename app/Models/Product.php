<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'producId',
        'name',
        'description',
        'quantity',
        'price',
    ];

    protected $hidden   = ['created_at', 'updated_at', 'deleted_at'];

    protected $table = 'products';

    protected $primaryKey = 'productId';
}
