<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = ['user_id', 'default_address', 'country_id', 'type', 'first_name', 'last_name', 'company_name', 'address1', 'address2', 'postcode', 'city', 'state', 'phone'];

    public function countries()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}
