<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{

    protected $fillable = [
        'title', 'sku', 'description'
    ];

    public function productVariante(){
        return $this->hasMany(ProductVariant::class, 'id', 'id');
    }

}
