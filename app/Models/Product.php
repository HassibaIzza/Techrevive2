<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'product_name',
        'product_code',
        'product_tags',
        'product_colors',
        'product_short_description',
        'product_long_description',
        'product_slug',
        'product_price',
        'product_thumbnail',
        'product_status',
        'sub_category_id',
        'brand_id',
        'vendor_id',
        'product_quantity'
    ];

    public function images()
    {
        return $this->hasMany(product_images::class, 'image_product_id');
    }
}
