<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_img',
        'i_product_id'
    ];


    public function iProducts()
    {
        return $this->belongsTo(IProduct::class);
    }
}
