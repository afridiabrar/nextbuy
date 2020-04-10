<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['sent_time', 'sent_slot', 'sent_date', 'order_id', 'note', 'user_id', 'billing_address_id', 'payment_type', 'status', 'receipt_no', 'order', 'total_amount', 'discounted_amount', 'coupon_id'];



    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'billing_address_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function order_product()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }
}
