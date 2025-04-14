<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'iproduct_id',
        'product_img'
    ];


    public function iProducts()
    {
        return $this->belongsTo(IProduct::class);
    }
}
