<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Coupon;
use App\Order;
use App\OrderProduct;
use App\Payment;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPSTORM_META\type;
use Stripe\Charge;
use Stripe\Stripe;
use App\Mail\MobileReceiptMail;
use Mail;
use stdClass;

class OrderController extends Controller
{
    //


    public $successStatus  = 200;
    public $secret_key = "sk_test_1bD9yiNMigTHURQahmoS3S4800IPAc8qQX";

    public function __construct()
    {
        Stripe::setApiKey($this->secret_key);
    }
    public function paymentStore(Request $request)
    {

        $cart = json_decode($request->cart);
        // $getCart = Cart::getContent();
        $user = $request->user();
        $address = Address::where('user_id', $user->id)->first();
        if (empty($address)) {
            return response()->json(['status' => 'error', 'msg' => 'No Address Found!'], $this->successStatus);
        }
        $getTotal = $request->total_price;
        //Get coupon By Name for discouted price or percentage
        if ($request->code) {
            $coupon = Coupon::where('code', $request->code)->where('status', 'Active')->first();
            if ($coupon) {
                if ($coupon->type == 'percentage') {
                    $order['total_amount'] = $getTotal;
                    $getTotal = ($coupon->coupon_value / 100) * $getTotal;
                    $order['discounted_amount'] = $getTotal;
                    $order['coupon_id'] = $coupon->id;
                } elseif ($coupon->type == 'dollar') {
                    if ($getTotal > $coupon->coupon_value) {
                        $order['total_amount'] = $getTotal;
                        $getTotal = $getTotal - $coupon->coupon_value;
                        $order['discounted_amount'] = $getTotal;
                        $order['coupon_id'] = $coupon->id;
                    }
                }
            } else {
                return response()->json(['status' => 'error', 'msg' => 'Invalid Coupon'], $this->successStatus);
            }
        }
        //Insert Order Detail after successfully charge the Card
        $dataaa = Order::latest('id')->first(); // This is fetched from database
        $last = (!empty($dataaa)) ? $dataaa->id : 1;
        $last++;
        $invoice_number = "Invoice#" . $last;
        $order['user_id'] = $user->id;
        $order['receipt_no'] = $invoice_number;
        $order['billing_address_id'] = (!empty($address->id)) ? $address->id : NULL;
        $order['payment_type'] = $request->payment_type;
        $order['total_amount'] = $request->total_price;
        $order['sent_date'] = $request->sent_date;
        $order['sent_time'] = $request->sent_time;
        $order['note'] = $request->note;
        $order['status'] = 'Pending';

        $orderadded = Order::create($order);
        $getCart = new stdClass;
        $getCart->invoice_no = $invoice_number;
        $getCart->name = $user->f_name . ' ' . $user->l_name;
        $getCart->email = $user->email;
        $getCart->order_date = date('y-m-d');
        $getCart->address1 = $address->address1;
        $getCart->city =  $address->postcode . ' ,' . $address->city . ' ,' . $address->state;
        $getCart->phone_no = $address->phone;
        $getCart->getTotal = $request->total_price;
        //$getCart->getTotal = $data;
        //print_r($data);
        foreach ($cart as $kk => $vv) {
            // var_dump($vv);
            $product = Product::where('id', $vv->id)->first();
            $cart[$kk]->name = $product->name;
            $cart[$kk]->price = $product->price;
        }
        $getCart->data = $cart;
        $this->OrderMail($getCart);
        if ($orderadded) {
            //Insert Orderproduct After Created order
            foreach ($cart as $kk => $vv) {
                $productData = Product::where('id', $vv->id)->first();
                $orderProduct['order_id'] = $orderadded->id;
                $orderProduct['product_id'] = $vv->id;
                $orderProduct['qty'] = $vv->qty;
                $orderProduct['price'] = $productData->price;
                $orderProduct['total_amount'] = $vv->qty * $productData->price;
                OrderProduct::create($orderProduct);
            }
            return response()->json(['status' => 'success', 'msg' => 'Your Order Has Been Placed Successfully!'], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Please try Again!'], $this->successStatus);
        }
    }

    public function OrderMail($getCart)
    {
        return Mail::to($getCart->email)->send(new MobileReceiptMail($getCart));
    }
    public function GetOrdersById(Request $request)
    {
        $user = $request->user();
        $order = Order::where('user_id', $user->id)->get();
        $products = array();
        foreach ($order as $k => $v) {
            $Product = OrderProduct::where('order_id', $v->id)->with('product')->with('product.productImages')->get();
            $products[] = $Product;
        }
        // return response()->json(['status' => 'success', 'data' => $products, 'msg' => 'Data Found'], $this->successStatus);
        // $order = Order::where('user_id', $user->id)->with('order_product.product')->with('address')->with('order_product')->with('payments')->with('order_product.product')->paginate(10);
        if ($products) {
            return response()->json(['status' => 'success', 'data' => $products, 'msg' => 'Data Found'], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Not Found'], $this->successStatus);
        }
    }
}
