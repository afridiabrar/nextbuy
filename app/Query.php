<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    //
    protected $fillable = ['user_id', 'name', 'email', 'phone_no', 'query_type', 'message', 'is_responded', 'admin_respond'];
}
