<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_address',
        'total_price',
    ];

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

}
