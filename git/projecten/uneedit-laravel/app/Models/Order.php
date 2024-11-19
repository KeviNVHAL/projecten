<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'delivery_service', 'delivery_date', 'delivery_time'];

    // An order can have many products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product_junction')->withPivot('quantity')->withTimestamps();
    }
}
