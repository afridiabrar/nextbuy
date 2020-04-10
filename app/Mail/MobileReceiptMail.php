<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MobileReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $getCart;

    public function __construct($getCart)
    {

        $this->user = $getCart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('email.invoice')->with([
            'name' => $this->user->name,

            'invoice_no' => $this->user->invoice_no,
            'order_date' => $this->user->order_date,
            'address1' => $this->user->address1,
            'city' => $this->user->city,
            'phone_no' => $this->user->phone_no,
            'getTotal' => $this->user->getTotal,
            'data' => $this->user->data
        ]);
    }
}
