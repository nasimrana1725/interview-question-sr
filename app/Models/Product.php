<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description'
    ];

    public function productVariante(){
        return $this->hasMany(ProductVariant::class, 'id', 'id');
    }

    public function productVariantePrice(){
        return $this->hasMany(ProductVariantPrice::class, 'id', 'id');
    }

}
