<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IProduct extends Model
{
    protected $fillable = [
        'product_name',
        'sub_title',
        'sku',
        'description',
        'price',
        'category_id',
        'color_id',
        'size_id',
    ];

    // Add this if timestamps are not being set automatically
    public $timestamps = true;

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'i_product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
