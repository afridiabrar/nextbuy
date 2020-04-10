<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReceiptMail extends Mailable
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
        echo "<pre>";
        print_r($getCart);
        echo "</pre>";
        $this->user = $getCart;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice_no = $this->user->invoice_no;
        $order_date =  $this->user->order_date;
        $address1 =  $this->user->address1;
        $city =  $this->user->city;
        $phone_no =  $this->user->phone_no;
        $getTotal =  $this->user->getTotal;
        return $this->view('email.receipt')->with([
            'invoice_no' => $this->user->invoice_no,
            'order_date' => $this->user->order_date,
            'address1' => $this->user->address1,
            'city' => $this->user->city,
            'phone_no' => $this->user->phone_no,
            'getTotal' => $this->user->getTotal,
            'data' => $this->user
        ]);;
    }
}
