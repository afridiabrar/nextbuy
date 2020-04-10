<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    //
    protected $fillable = ['title', 'slug', 'banner_image', 'status'];
}
