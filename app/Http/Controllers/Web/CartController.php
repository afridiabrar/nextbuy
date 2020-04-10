<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Cart;

class CartController extends Controller
{
    //
    public function cart()
    {
        $getCart = Cart::getContent();
        $total = $getCart->count();
        $getTotal = Cart::getTotal();
        return view('web.pages.cart', ['cart' => $getCart, 'totalCartCount' => $total, 'getTotal' => $getTotal]);
    }

    public function removeItem($id)
    {
        $remove =  Cart::remove($id);
        if ($remove) {
            session()->flash('success', 'Your Cart Item Has Been Removed!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Error Occured Please Try Again Letter');
            return redirect()->back();
        }
    }

    public function singleCart($id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            session()->flash('error', 'Data Not Found!');
            return \redirect(route('category'));
        }
        $cartData = cart::get($id);
        if ($product->in_stock > 1) {
            $total = (!empty($cartData) && $cartData->attributes->p_total) ? $cartData->attributes->p_total + $product->price : 1 * $product->price;
            $cart =  Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => array(
                    'image' => $product->featured_image,
                    'p_total' => $total
                )
            ));
            if ($cart) {
                session()->flash('success', 'Your Cart Has Been Updated');
                return redirect()->back();
            } else {
                session()->flash('error', 'Error Occured Please Try Again Letter');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Stock Quantity Must Be less Then Stock Or equal to In Stock');
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        $product = Product::find($request->p_id);
        if (empty($product)) {
            session()->flash('error', 'Data Not Found!');
            return \redirect(route('category'));
        }
        if ($request->qty > 0 &&   $request->qty <= $product->in_stock) {
            $cartdata = Cart::get($request->p_id);
            $qty = (!empty($cartdata) && $cartdata->quantity) ? $cartdata->quantity + $request->qty : 1 * $request->qty;
            //$qty = $cartdata->quantity + $request->qty;
            $cart =  Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->qty,
                'attributes' => array(
                    'image' => $product->featured_image,
                    'p_total' => $qty * $product->price
                )
            ));
            if ($cart) {
                session()->flash('success', 'Your Cart Has Been Updated');
                return redirect()->back();
            } else {
                session()->flash('error', 'Error Occured Please Try Again Letter');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Stock Quantity Must Be less Then Stock Or equal to In Stock');
            return redirect()->back();
        }
    }


    public function AjaxCart(Request $request)
    {

        $product = Product::find($request->p_id);
        $response = '';
        if (empty($product)) {
            session()->flash('error', 'Data Not Found!');
            return \redirect(route('category'));
        }
        $cartData = cart::get($request->p_id);
        if ($product->in_stock > 1) {
            $total = (!empty($cartData) && $cartData->attributes->p_total) ? ($request->type == 'plus') ? $cartData->attributes->p_total + $product->price : $cartData->attributes->p_total - $product->price : 1 * $product->price;
            $finalQty = ($request->type == 'plus') ? 1 : -1;
            if ($request->type == 'plus') {
                $cart =  Cart::add(array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $finalQty,
                    'attributes' => array(
                        'image' => $product->featured_image,
                        'p_total' => $total
                    )
                ));
            } else {
                $cart = Cart::update($request->p_id, array(
                    'quantity' => -1, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
                    'attributes' => array(
                        'image' => $product->featured_image,
                        'p_total' => $total
                    )
                ));
            }
            if ($cart) {
                $resp['status'] = 'success';
                $resp['total'] =  number_format($total, 2);
                $resp['total_amount'] = Cart::getTotal();
                // $getTotal = Cart::getTotal();
                // $response['total'] = $getTotal;
                // $response['success'] = 'success';
                // echo $response;
            } else {
                //                $response['status']  = 'Error Occured Please Try Again Letter';
                $resp['status'] = 'error';
            }
        } else {
            $resp['status'] = 'qty_error';
            //   echo 'qty_error';
            //            $response['error']  = 'Stock Quantity Must Be less Then Stock Or equal to In Stock';
        }
        echo json_encode($resp);
    }
}
