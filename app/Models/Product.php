<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'sku',
        'product_type', // frame, lens, accessory
        'price',
        'stock_quantity',
        'category_id',
        'description',
        'image_path',
        'specs', // JSON
    ];

    protected $casts = [
        'specs' => 'array',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
