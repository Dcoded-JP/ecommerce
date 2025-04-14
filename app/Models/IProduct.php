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

    public function categories(){
        return $this->hasOne(Category::class);
    }

    public function colors(){
        return $this->hasOne(Color::class);
    }

    public function sizes(){
        return $this->hasOne(Size::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

}
