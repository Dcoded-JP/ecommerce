<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IProductColor extends Model
{
    protected $fillable = ['i_product_id', 'color_id'];

    public function iProduct()
    {
        return $this->belongsTo(IProduct::class);
    }   

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    
}
