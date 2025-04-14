<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'size_name'
    ];


    public function iProducts()
    {
        return $this->belongsTo(IProduct::class);
    }
}
