<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $fillable = ['name', 'code', 'phone_code', 'currency_code', 'currency_symbol', 'lang_code'];
}
