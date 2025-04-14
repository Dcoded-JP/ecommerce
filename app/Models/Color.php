<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = [
        'color_name'
    ];



    public function iProducts()
    {
        return $this->belongsTo(IProduct::class);
    }
}
