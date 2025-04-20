<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{

    use HasFactory;

    // Allow these fields for mass assignment
    protected $fillable = [
        'product_id',
        'name',
        'price',
        'quantity',
        'order_id',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
