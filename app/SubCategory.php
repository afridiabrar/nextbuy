<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    //

    protected $fillable = ['category_id', 'name', 'status', 'slug', 'banner_image', 'link'];

    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }


    public function product()
    {
        return $this->hasMany(Product::class, 'sub_category_id', 'id');
    }
}
