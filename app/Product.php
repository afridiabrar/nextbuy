<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['qty','in_stock','category_id', 'category_name', 'sub_category_id', 'sub_category_name', 'is_featured', 'type', 'sku', 'name', 'product_slug', 'description', 'short_description', 'tax_status', 'weight', 'length', 'width', 'height', 'price', 'featured_image', 'color', 'other_information', 'extra_discount', 'is_deleted'];


    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function sub_category()
    {
        return $this->hasOne(SubCategory::class, 'id', 'sub_category_id');
    }

    public function ProductImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
