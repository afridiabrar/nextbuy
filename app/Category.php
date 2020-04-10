<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name', 'slug', 'icon', 'hover_icon'];




    public function sub_category()
    {
        return $this->hasMany(SubCategory::class,'category_id','id');
    }

}
