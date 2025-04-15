<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IProductSize extends Model
{
    protected $fillable = ['i_product_id', 'size_id'];

    public function iProduct()
    {
        return $this->belongsTo(IProduct::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
