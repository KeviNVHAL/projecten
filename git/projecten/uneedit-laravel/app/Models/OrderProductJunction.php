<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductJunction extends Model
{
    use HasFactory;

    protected $table = 'order_product_junction';
    protected $fillable = ['order_id', 'product_id'];
}