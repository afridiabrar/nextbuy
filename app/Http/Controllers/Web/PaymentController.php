<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderProduct;
use Stripe\Stripe;
use Stripe\Charge;
use Auth;
use App\User;
use Cart;
use App\Address;
use App\Order;
use App\OrderProcut;
use App\Payment;
use App\Mail\ReceiptMail;
use App\Product;
use Mail;

class PaymentController extends Controller
{
    //
    public $secret_key = "sk_test_1bD9yiNMigTHURQahmoS3S4800IPAc8qQX";

    public function __construct()
    {
        Stripe::setApiKey($this->secret_key);
    }
    public function store(Request $request)
    {

        $getCart = Cart::getContent();

        $user = Auth::user();
        $getTotal = Cart::getTotal();
        if (empty($user)) {
            session()->flash('error', 'You Need to Login First For Further Proccess!');
            return redirect(route('authentication'));
        }
        $address = Address::where('user_id', $user->id)->where('default_address', 1)->first();
        try {
            $getCart = Cart::getContent();

            $getTotal = Cart::getTotal();
            $chargeparms = [
                'amount' => $getTotal * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Your Wish On Payments"
            ];
            try {
                $charge = Charge::create($chargeparms);
                if ($charge) {
                    //Insert Order Detail after successfully charge the Card
                    $dataaa = Order::latest('id')->first(); // This is fetched from database
                    $last = $dataaa->id;
                    $last++;
                    $invoice_number = "Invoice#" . $last;
                    $getCart->invoice_no = $invoice_number;
                    $getCart->email = $user->email;
                    $getCart->order_date = date('y-m-d');
                    $getCart->address1 = $address->address1;
                    $getCart->city =  $address->postcode . ' ,' . $address->city . ' ,' . $address->state;
                    $getCart->phone_no = $address->phone;
                    $getCart->getTotal = $getTotal;
                    $this->OrderMail($getCart);
                    $order['user_id'] = $user->id;
                    $order['receipt_no'] = $invoice_number;
                    $order['billing_address_id'] = $address->id;
                    $order['payment_type'] = 'Card';
                    $order['status'] = 'Pending';
                    $orderadded = Order::create($order);
                    if ($orderadded) {
                        //Insert Payment After Order Created Succuessfully                    
                        $paymentAdd['order_id'] = $orderadded->id;
                        $paymentAdd['user_id'] = $user->id;
                        $paymentAdd['total_amount'] = $getTotal;
                        $paymentAdd['transaction_id'] = $charge->id;
                        $paymentAdd['payment_type'] = 'Card';
                        $paymentAdd['status'] = 'Done';
                        Payment::create($paymentAdd);
                        //Insert Orderproduct After Created order
                        foreach ($getCart as $kk => $vv) {
                            $orderProduct['order_id'] = $orderadded->id;
                            $orderProduct['product_id'] = $vv->id;
                            $orderProduct['qty'] = $vv->quantity;
                            $orderProduct['price'] = $vv->price;
                            $orderProduct['total_amount'] = $vv->attributes->p_total;
                            OrderProduct::create($orderProduct);

                            $productData = Product::where('id', $vv->id)->first();
                            $productUpdate['in_stock']  = $productData['in_stock'] - $vv->quantity;
                            $productUpdate['track_stock']  = $productData['track_stock'] + $vv->quantity;
                            Product::where('id', $vv->id)->update($productUpdate);
                        }
                        Cart::clear();
                        session()->flash('success', 'Your Order Has Been Placed Successfully!');
                        return redirect(route('thankyou'));
                    } else {
                        session()->flash('error', 'Please try Again!');
                        return redirect()->back();
                    }
                } else {
                    session()->flash('error', 'Payment Not Charged!');
                    return redirect()->back();
                }
            } catch (Exception $e) {
                return Redirect::route('membership')
                    ->with('error', $e->getMessage());
            }
        } catch (ModelNotFoundException $e) {
            return Redirect::route('membership')
                ->with('error', 'Invalid Data');
        }
    }

    public function MailReciept()
    {
        $address = Address::where('user_id', 2)->where('default_address', 1)->first();
        $data = Order::latest('id')->first();
        $last = $data->id; // This is fetched from database
        $last++;
        $invoice_number = "Invoice#" . $last;
        $getCart = Cart::getContent();
        $getTotal = Cart::getTotal();
        $getCart->invoice_no = $invoice_number;
        $getCart->email = 'abrar@gmail.com';
        $getCart->order_date = '11-11-2019';
        $getCart->address1 = $address->address1;
        $getCart->city =  $address->postcode . ' ,' . $address->city . ' ,' . $address->state;
        $getCart->phone_no = $address->phone;
        $getCart->getTotal = $getTotal;
        $this->OrderMail($getCart);
    }
    public function OrderMail($getCart)
    {
        return Mail::to($getCart->email)->send(new ReceiptMail($getCart));
    }
}
