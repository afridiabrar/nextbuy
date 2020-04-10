<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $fillable = ['product_id', 'prouct_images', 'type'];

    public function ProductImage()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }

}
