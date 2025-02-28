<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // ✅ Ensure this is included

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'slug', 'description', 'short_description',
        'price', 'discount_price', 'stock', 'sku', 'image', 'tags',
        'meta_title', 'meta_description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
