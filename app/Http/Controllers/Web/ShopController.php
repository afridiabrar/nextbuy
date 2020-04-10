<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Cart;
use App\Address;
use App\Product;

class ShopController extends Controller
{
    //

    public function index()
    {
        $product = Product::orderBy('id', 'DESC')->with('categories')->with('productImages')->paginate(6);
        return view('web.pages.shop', ['product' => $product]);
    }

    public function checkout()
    {
        $user = Auth::user();
        if (!empty($user) && $user->is_admin == 0) {
            $getTotal = Cart::getTotal();
            $address = Address::where('user_id', $user->id)->with('countries')->get();
            $single_address = Address::where('user_id', $user->id)->where('default_address', 1)->first();

            return view('web.pages.checkout', ['total' => $getTotal, 'address' => $address, 's_address' => $single_address]);
        } else {
            session()->flash('error', 'You Need to Login First For Further Proccess!');
            return \redirect(route('authentication'));
        }
    }

    public function search(Request $request)
    {
        if (!empty($request->sortby)) {
            $sort = $request->sortby;
            if ($sort == 'A-Z') {
                $product = Product::orderBy('name', 'ASC')->with('categories')->with('productImages')->paginate(6);
            } elseif ($sort == 'Z-A') {
                $product = Product::orderBy('name', 'DESC')->with('categories')->with('productImages')->paginate(6);
            } elseif ($sort == 'price') {
                $product = Product::orderBy('price', 'ASC')->with('categories')->with('productImages')->paginate(6);
            } elseif ($sort == 'main_search') {
                $product = Product::where('name', 'LIKE', '%' . $request->search . '%')->where('slug', $request->search_category)->with('categories')->with('productImages')->paginate(6);
            }
            if ($product) {
                return view('web.pages.shop', ['product' => $product]);
            } else {
                session()->flash('error', 'No Result Found!');
            }
        }
    }
}
