<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = ['order_id', 'user_id', 'total_amount', 'transaction_id', 'payment_type', 'status'];

    public function orders()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
