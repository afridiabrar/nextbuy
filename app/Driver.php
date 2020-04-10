<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //

    protected $fillable = ['name', 'phone_no', 'driving_lic', 'email', 'Address', 'city', 'phone_no_2', 'identity', 'status'];
}
