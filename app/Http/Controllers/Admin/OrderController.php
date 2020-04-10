<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use App\Product;

class OrderController extends Controller
{
    //
    public function edit_order($id)
    {
        $order = Order::where('id', $id)->with(['user', 'address', 'order_product', 'order_product.product'])->first();
        return view('admin.pages.edit_order', ['order' => $order]);
    }

    public function UpdateOrder(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            $data = $request->except(['_token', 'dtBasicExample_length']);
            Order::where('id', $id)->update($data);
            session()->flash('success', 'Order Updated');
            return redirect()->back();
        } else {
            session()->flash('error', 'Not Found!');
            return redirect()->back();
        }
    }

    public function storeItem(Request $request)
    {
        $product_id = $request->product_id;
        $order = OrderProduct::where('order_id', $request->order_id)->where('product_id', $product_id)->first();
        $productData = Product::where('id', $product_id)->first();
        $orderData = Order::where('id', $request->order_id)->first();
        $grandTotal = 0;
        if ($order) {
            $update['qty'] = $order->qty + $request->qty;
            $total = $request->qty * $productData->price;
            $update['total_amount'] = $order->total_amount +  $total;
            OrderProduct::where('id', $order->id)->update($update);
        } else {
            $add['qty'] = $request->qty;
            $add['product_id'] = $product_id;
            $add['order_id'] = $request->order_id;
            $add['price'] = $productData->price;
            $add['total_amount'] = $request->qty * $productData->price;
            OrderProduct::create($add);
        }
        if ($orderData->coupon_id) {
            $p_order = OrderProduct::where('order_id', $request->order_id)->get();
            foreach ($p_order as $kk => $vv) {
                $grandTotal +=  $vv->total_amount;
                $coupon = Coupon::where('id', $orderData->coupon_id)->first();
                if ($coupon) {
                    if ($coupon->type == 'percentage') {
                        $orderUpdateee['total_amount'] = $grandTotal;
                        $getTotal = ($coupon->coupon_value / 100) * $grandTotal;
                        $orderUpdateee['discounted_amount'] = $getTotal;
                        $orderUpdateee['coupon_id'] = $coupon->id;
                    } elseif ($coupon->type == 'dollar') {
                        if ($getTotal > $coupon->coupon_value) {
                            $orderUpdateee['total_amount'] = $getTotal;
                            $getTotal = $getTotal - $coupon->coupon_value;
                            $orderUpdateee['discounted_amount'] = $getTotal;
                            $orderUpdateee['coupon_id'] = $coupon->id;
                        }
                    }
                }
            }
            Order::where('id', $orderData->id)->update($orderUpdateee);
        } else {
            $p_order = OrderProduct::where('order_id', $request->order_id)->get();
            foreach ($p_order as $kk => $vv) {
                $grandTotal +=  $vv->total_amount;
            }
            Order::where('id', $orderData->id)->update(['total_amount' => $grandTotal]);
        }
        session()->flash('success', 'Successfully Added');
        return redirect()->back();
    }

    public function additem($id)
    {
        $order = Order::find($id);
        $product = Product::get();
        return view('admin.popup.add_item', ['product' => $product, 'order' => $order]);
    }

    public function AjaxCart(Request $request)
    {
        $product = Product::find($request->p_id);
        $response = '';
        if (empty($product)) {
            session()->flash('error', 'Product Not Found!');
            return redirect()->back();
        }
        $cartData = OrderProduct::where('product_id', $request->p_id)->where('order_id', $request->order_id)->first();
        $orderData = Order::where('id', $request->order_id)->first();
        $getTotal = 0;
        $grandTotal = 0;
        // if ($product->in_stock > 1) {
        // $total = (!empty($cartData) && $cartData->total_amount) ? ($request->type == 'plus') ? $cartData->total_amount + $product->price : $cartData->total_amount - $product->price : 1 * $product->price;
        // $finalQty = ($request->type == 'plus') ? 1 : -1;
        $total = 0;
        if ($request->type == 'plus') {
            $qty = $cartData->qty + 1;
            $update['qty'] = $qty;
            $update['total_amount'] = $qty * $product->price;
            $total  = $qty * $product->price;
            $cart = OrderProduct::where('id', $cartData->id)->update($update);
        } else {
            $qty = $cartData->qty - 1;
            $update['qty'] = $qty;
            $update['total_amount'] = $qty * $product->price;
            $total  = $qty * $product->price;
            $cart =  OrderProduct::where('id', $cartData->id)->update($update);
        }
        if ($orderData->coupon_id) {
            $p_order = OrderProduct::where('order_id', $request->order_id)->get();
            foreach ($p_order as $kk => $vv) {
                $grandTotal +=  $vv->total_amount;
                $coupon = Coupon::where('id', $orderData->coupon_id)->first();
                if ($coupon) {
                    if ($coupon->type == 'percentage') {
                        $orderUpdateee['total_amount'] = $grandTotal;
                        $getTotal = ($coupon->coupon_value / 100) * $grandTotal;
                        $orderUpdateee['discounted_amount'] = $getTotal;
                        $orderUpdateee['coupon_id'] = $coupon->id;
                    } elseif ($coupon->type == 'dollar') {
                        if ($getTotal > $coupon->coupon_value) {
                            $orderUpdateee['total_amount'] = $getTotal;
                            $getTotal = $getTotal - $coupon->coupon_value;
                            $orderUpdateee['discounted_amount'] = $getTotal;
                            $orderUpdateee['coupon_id'] = $coupon->id;
                        }
                    }
                }
            }
            Order::where('id', $orderData->id)->update($orderUpdateee);
        } else {
            $p_order = OrderProduct::where('order_id', $request->order_id)->get();
            foreach ($p_order as $kk => $vv) {
                $grandTotal +=  $vv->total_amount;
            }
            Order::where('id', $orderData->id)->update(['total_amount' => $grandTotal]);
        }
        if ($cart) {
            $resp['status'] = 'success';
            $resp['total'] =  number_format($total, 2);
            $resp['total_amount'] = $grandTotal;
        } else {
            $resp['status'] = 'error';
        }
        // } else {
        //     $resp['status'] = 'qty_error';
        // }
        echo json_encode($resp);
    }

    //    public function AjaxCart(Request $request)
    //    {
    //        $product = Product::find($request->p_id);
    //        $response = '';
    //        if (empty($product)) {
    //            session()->flash('error', 'Product Not Found!');
    //            return redirect()->back();
    //        }
    //        //$cartData = cart::get($request->p_id);
    //        $cartData = OrderProduct::where('product_id', $request->p_id)->where('order_id', $request->order_id)->first();
    //        $orderData = Order::where('id', $request->order_id)->first();
    //        $getTotal = 0;
    //        $grandTotal = 0;
    //        if ($product->in_stock > 1) {
    //            // $total = (!empty($cartData) && $cartData->total_amount) ? ($request->type == 'plus') ? $cartData->total_amount + $product->price : $cartData->total_amount - $product->price : 1 * $product->price;
    //            // $finalQty = ($request->type == 'plus') ? 1 : -1;
    //            $total = 0;
    //            if ($request->type == 'plus') {
    //                $qty = $cartData->qty + 1;
    //                $update['qty'] = $qty;
    //                $update['total_amount'] = $qty * $product->price;
    //                $total  = $qty * $product->price;
    //                $cart = OrderProduct::where('id', $cartData->id)->update($update);
    //                $productUpdate['in_stock'] = $product->in_stock - 1;
    //                $productUpdate['track_stock'] = $product->track_stock + 1;
    //                Product::where('id', $product->id)->update($productUpdate);
    //            } else {
    //                $qty = $cartData->qty - 1;
    //                $update['qty'] = $qty;
    //                $update['total_amount'] = $qty * $product->price;
    //                $total  = $qty * $product->price;
    //                $cart =  OrderProduct::where('id', $cartData->id)->update($update);
    //                $productUpdate['in_stock'] = $product->in_stock + 1;
    //                $productUpdate['track_stock'] = $product->track_stock - 1;
    //                Product::where('id', $product->id)->update($productUpdate);
    //            }
    //            if ($orderData->coupon_id) {
    //                $p_order = OrderProduct::where('order_id', $request->order_id)->get();
    //                foreach ($p_order as $kk => $vv) {
    //                    $grandTotal +=  $vv->total_amount;
    //                    $coupon = Coupon::where('id', $orderData->coupon_id)->first();
    //                    if ($coupon) {
    //                        if ($coupon->type == 'percentage') {
    //                            $orderUpdateee['total_amount'] = $grandTotal;
    //                            $getTotal = ($coupon->coupon_value / 100) * $grandTotal;
    //                            $orderUpdateee['discounted_amount'] = $getTotal;
    //                            $orderUpdateee['coupon_id'] = $coupon->id;
    //                        } elseif ($coupon->type == 'dollar') {
    //                            if ($getTotal > $coupon->coupon_value) {
    //                                $orderUpdateee['total_amount'] = $getTotal;
    //                                $getTotal = $getTotal - $coupon->coupon_value;
    //                                $orderUpdateee['discounted_amount'] = $getTotal;
    //                                $orderUpdateee['coupon_id'] = $coupon->id;
    //                            }
    //                        }
    //                    }
    //                }
    //                Order::where('id', $orderData->id)->update($orderUpdateee);
    //            } else {
    //                $p_order = OrderProduct::where('order_id', $request->order_id)->get();
    //                foreach ($p_order as $kk => $vv) {
    //                    $grandTotal +=  $vv->total_amount;
    //                }
    //                Order::where('id', $orderData->id)->update(['total_amount' => $grandTotal]);
    //            }
    //            if ($cart) {
    //                $resp['status'] = 'success';
    //                $resp['total'] =  number_format($total, 2);
    //                $resp['total_amount'] = $grandTotal;
    //            } else {
    //                $resp['status'] = 'error';
    //            }
    //        } else {
    //            $resp['status'] = 'qty_error';
    //        }
    //        echo json_encode($resp);
    //    }

    public function orderProductdelete($id)
    {
        $orderProduct = OrderProduct::find($id);
        if ($orderProduct) {
            $product = Product::where('id', $orderProduct->product_id)->first();
            $productUpdate['in_stock'] = $product->in_stock + $orderProduct->qty;
            $productUpdate['track_stock'] = $product->track_stock - $orderProduct->qty;
            Product::where('id', $product->id)->update($productUpdate);
            OrderProduct::where('id', $orderProduct->id)->delete();
            $orderData = Order::where('id', $orderProduct->order_id)->first();
            $grandTotal = 0;
            if ($orderData->coupon_id) {
                $p_order = OrderProduct::where('order_id', $orderProduct->order_id)->get();
                foreach ($p_order as $kk => $vv) {
                    $grandTotal +=  $vv->total_amount;
                    $coupon = Coupon::where('id', $orderData->coupon_id)->first();
                    if ($coupon) {
                        if ($coupon->type == 'percentage') {
                            $orderUpdateee['total_amount'] = $grandTotal;
                            $getTotal = ($coupon->coupon_value / 100) * $grandTotal;
                            $orderUpdateee['discounted_amount'] = $getTotal;
                            $orderUpdateee['coupon_id'] = $coupon->id;
                        } elseif ($coupon->type == 'dollar') {
                            if ($getTotal > $coupon->coupon_value) {
                                $orderUpdateee['total_amount'] = $getTotal;
                                $getTotal = $getTotal - $coupon->coupon_value;
                                $orderUpdateee['discounted_amount'] = $getTotal;
                                $orderUpdateee['coupon_id'] = $coupon->id;
                            }
                        }
                    }
                }
                Order::where('id', $orderData->id)->update($orderUpdateee);
            } else {
                $p_order = OrderProduct::where('order_id', $orderProduct->order_id)->get();
                foreach ($p_order as $kk => $vv) {
                    $grandTotal +=  $vv->total_amount;
                }
                Order::where('id', $orderData->id)->update(['total_amount' => $grandTotal]);
            }
            session()->flash('success', 'Product Order Deleted!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Not Found!');
            return redirect()->back();
        }
    }
}
