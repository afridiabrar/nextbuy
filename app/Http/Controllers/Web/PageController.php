<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Order;
use Validator;
use App\Query;
use App\Page;

class PageController extends Controller
{
    //

    // public function contactStore()
    // { }
    public function contact()
    {
        return view('web.pages.contact-us');
    }

    public function help()
    {
        return view('web.pages.help-and-faqs');
    }

    public function order()
    {
        $user = Auth::user();
        if ($user) {
            $order = Order::where('user_id', $user->id)->with('address')->with('order_product')->get();
            return view('web.pages.order', ['order' => $order]);
        } else {
            session()->flash('error', 'Please Login First!');
            return \redirect(route('authentication'));
        }
    }

    public function orderDetail($id)
    {
        $user = Auth::user();
        if ($user) {
            $order = Order::where('id', $id)->where('user_id', $user->id)->with(['address', 'order_product', 'order_product.product'])->first();
            return view('web.pages.order-view', ['order' => $order]);
        } else {
            session()->flash('error', 'Please Login First!');
            return \redirect(route('authentication'));
        }
    }

    public function thankyou()
    {
        return view('web.pages.thankyou');
    }

    public function term()
    {
        $page = Page::where('id', 1)->first();
        return view('web.pages.term', ['page' => $page]);
    }

    public function privacy()
    {
        $page = Page::where('id', 1)->first();
        return view('web.pages.privacy', ['page' => $page]);
    }

    public function contactStore(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phone_no' => 'required',
                'message' => 'required',

            ],
            [
                'name.required' => "Full Name is Required",
                'phone_no.required' => "Phone Number is Required",
                'email.required' => "Email is Required",
                'email.email' => "Email Is Badly Formated",
                'message.required' => "Message is Required",
            ]
        );

        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));

            return redirect()->back()->withInput();
        }

        $request['query_type'] = 'Contact';
        $request['user_id'] = (!empty($user) && $user->is_admin == 0) ? $user->id : NULL;

        $user = Query::create($request->all());
        if ($user) {
            session()->flash('success', 'Your Message Has Been Sent!');
            return redirect()->back();
        } else {
            session()->flash('success', 'Some Error Occured');
            return redirect()->back();
        }
    }
}
