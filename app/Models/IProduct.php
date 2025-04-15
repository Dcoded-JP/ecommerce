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

    protected $casts = [
        'color_id' => 'array',
        'size_id' => 'array',
        'price' => 'decimal:2'
    ];

    // Add this if timestamps are not being set automatically
    public $timestamps = true;

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'i_product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function colors()
    {
        return Color::whereIn('id', $this->color_id ?? []);
    }

    public function sizes()
    {
        return Size::whereIn('id', $this->size_id ?? []);
    }


    public function getColorsCollectionAttribute()
    {
        return $this->colors()->get();
    }

    public function getSizesCollectionAttribute()
    {
        return $this->sizes()->get();
    }

    public function getColorDetailsAttribute()
    {
        if (!is_array($this->color_id)) {
            $this->color_id = json_decode($this->color_id, true) ?? [];
        }
        return Color::whereIn('id', $this->color_id)->get();
    }

    public function getSizeDetailsAttribute()
    {
        if (!is_array($this->size_id)) {
            $this->size_id = json_decode($this->size_id, true) ?? [];
        }
        return Size::whereIn('id', $this->size_id)->get();
    }
}
